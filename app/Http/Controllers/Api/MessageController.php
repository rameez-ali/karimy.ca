<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\Notification;
use App\Item;
use App\Setting;
use Cmgmyr\Messenger\Models\Message;
use Cmgmyr\Messenger\Models\Participant;
use Cmgmyr\Messenger\Models\Thread;
use App\ThreadItem;
use App\User;
use Auth;
use Carbon\Carbon;
use stdClass;
use DB;


class MessageController extends Controller
{
    public function my_messages()
    {
        // All threads that user is participating in
        
        $threads = Thread::forUser(Auth::user()->id)->latest('updated_at')->get();
        
        foreach($threads as $thread){
            
            $threadItem = ThreadItem::where('thread_id',$thread->id)->first();
            
            $sendor = User::where('id',$thread->sender_id)->first();
            
            $item = Item::where('id',$threadItem->item_id)->first();
            
            $thread->creator_name = (Auth::user()->id!=$thread->recipeint_id) ? $item->item_title : $sendor->name;
            $thread->participants = $thread->participantsString();
            $thread->last_message = $thread->latestMessage->body;
            $thread->createdAt = $thread->latestMessage->createdAt;
            
            $thread->user_image = (Auth::user()->id!=$thread->recipeint_id) ? env('APP_URL') . '/storage/item/' . $item->item_image : env('APP_URL') . '/storage/user/user_image/' . $thread->creator()->user_image;
        }

        if($threads)
        {
            return response()->json([
                'result' => $threads,
                'message' => 'All Messages',
                'status'  => 0
              ], 200);
        }
        else{
           return response()->json([
                'message' => 'Something Went Wrong',
                'status'  => 0
              ], 200); 
        }
    }
    
    public function message_details($thread_id)
    {
        $thread = Thread::findOrFail($thread_id);

        if(!$thread->hasParticipant(Auth::user()->id))
        {
            return response()->json([
                'message' => 'You can only view your thread',
                'status'  => 0
              ], 200);
        }

        $thread_item = ThreadItem::where('thread_id', $thread->id)->first();
        $item = $thread_item->item()->first();


        // don't show the current user in list
        $login_user = Auth::user();

        if($thread->hasParticipant($login_user->id))
        {
            $thread->markAsRead($login_user->id);
        }
        
        $result = array();
        
        //dd($thread->messages);
        
        foreach($thread->messages as $key => $message)
        {
            
            $message->from = $message->user->name;
            $message->to = $thread->participantsString($message->user->id);
            $message->message = $message->body;
            $message->posted_at = $message->created_at->diffForHumans();
        }
        
        
        if ($thread->messages) {
            return response(["result" => $thread->messages, 'status' => '1', 'message' => 'Message Details'], 200);
        } else {
            return response(['status' => '0', 'message' => 'No Data Found'], 200);
        }
    }
    
    public function message_reply(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'thread_id' => 'required|numeric',
            'message' => 'required',
        ]);
        
        if($validator->fails()) return response()->json([
            'success'   => false,
            'error'     => $validator->errors(),
            'message'   => 'Invalid input, please check the errors.'
        ], 422);
        
        $thread = Thread::findOrFail($request->thread_id);
        $message = $request->message;
        $createdAt = $request->createdAt;
        $login_user = Auth::user();

        if(!$thread->hasParticipant($login_user->id))
        {
            \Session::flash('flash_message', __('alert.message-reply-error-own'));
            \Session::flash('flash_type', 'danger');

            return redirect()->route('user.messages.index');
        }

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => $login_user->id,
            'body' => $message,
            'createdAt' => $createdAt,
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => $login_user->id,
        ]);
        $participant->last_read = new Carbon;
        $participant->save();
        
        if($participant)
        {
            return response()->json([
                'message' => 'Reply Sent Successfully',
                'status'  => 1
              ], 200);
        }
        else{
            return response()->json([
                'message' => 'Something Went Wrong',
                'status'  => 0
              ], 200);
        }

    }

    public function send_message(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subject' => 'required|max:255',
            'message' => 'required',
            'recipient' => 'required|numeric',
            'item' => 'required|numeric',
        ]);
        
        if($validator->fails()) return response()->json([
            'success'   => false,
            'error'     => $validator->errors(),
            'message'   => 'Invalid input, please check the errors.'
        ], 422);

        $subject = $request->subject;
        $message = $request->message;
        $recipient_user_id = $request->recipient;
        $item_id = $request->item;
        $createdAt = $request->createdAt;

        $recipient_user_id_exist = User::find($recipient_user_id);
        if(empty($recipient_user_id_exist))
        {
            return response()->json([
                'message' => 'The recipient does not exist',
                'status'  => 0
              ], 200);
        }

        $item_id_exist = Item::find($item_id);
        if(empty($item_id_exist))
        {
            return response()->json([
                'message' => 'The listing does not exist',
                'status'  => 0
              ], 200);
        }
        if($item_id_exist->user_id != $recipient_user_id_exist->id)
        {
            return response()->json([
                'message' => 'Recipient and listing owner does not match',
                'status'  => 0
              ], 200);
        }

        $thread_id = DB::table('threads')->insertGetId(
                [
                'subject' => $request->subject, 
                'sender_id' => Auth::user()->id,
                'recipeint_id' => $request->recipient,
                ]
              );
        
        $thread = Thread::where('id',$thread_id)->first();
        
        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::user()->id,
            'body' => $message,
            'createdAt' => $createdAt,
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::user()->id,
            'last_read' => new Carbon,
        ]);

        // Recipients
        $thread->addParticipant($recipient_user_id);

        // Thread Item relation model
        $ThreadItem = ThreadItem::create([
            'thread_id' => $thread->id,
            'item_id' => $item_id_exist->id,
        ]);
        
        if($ThreadItem) {
          return response()->json([
            'message' => 'Message Sent Successfully',
            'status'  => 1
          ], 200);
        } else {
          return response()->json([
            'message' => 'Something went wrong.',
            'status'  => 0
          ], 400);
        }
    }

    
    public function send_message_to_admin(Request $request)
    {
        $settings = Setting::first();
        
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|max:255',
            'message' => 'required',
        ]);
        
        if($validator->fails()) return response()->json([
            'success'   => false,
            'error'     => $validator->errors(),
            'message'   => 'Invalid input, please check the errors.'
        ], 422);

        /**
         * Start initial SMTP settings
         */
        if($settings->settings_site_smtp_enabled == Setting::SITE_SMTP_ENABLED)
        {
            // config SMTP
            config_smtp(
                $settings->settings_site_smtp_sender_name,
                $settings->settings_site_smtp_sender_email,
                $settings->settings_site_smtp_host,
                $settings->settings_site_smtp_port,
                $settings->settings_site_smtp_encryption,
                $settings->settings_site_smtp_username,
                $settings->settings_site_smtp_password
            );
        }
        /**
         * End initial SMTP settings
         */

        if(!empty($settings->setting_site_name))
        {
            // set up APP_NAME
            config([
                'app.name' => $settings->setting_site_name,
            ]);
        }

        // send an email notification to admin
        $email_admin = User::getAdmin();
        $email_subject = __('email.contact.subject');
        $email_notify_message = [
            __('email.contact.body.body-1', ['first_name' => $request->first_name, 'last_name' => $request->last_name]),
            __('email.contact.body.body-2', ['subject' => $request->subject]),
            __('email.contact.body.body-3', ['first_name' => $request->first_name, 'last_name' => $request->last_name, 'email' => $request->email]),
            __('email.contact.body.body-4'),
            $request->message,
        ];

        try
        {
            // to admin
            $h1 = Mail::to("rameezali1995@gmail.com")->send(
                new Notification(
                    $email_subject,
                    $email_admin->name,
                    null,
                    $email_notify_message
                )
            );

            return response()->json([
                'message' => 'Email Sent to Admin',
                'status'  => 1
              ], 200);

        }
        catch (\Exception $e)
        {
            return response()->json([
                'message' => 'Something went wrong',
                'status'  => 0
              ], 200);
        }

    }

}