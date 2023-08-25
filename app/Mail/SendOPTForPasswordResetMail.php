<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendOPTForPasswordResetMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $settings;
    protected $user;
    protected $OTP;
    
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        $this->settings = $data['settings'];
        $this->user = $data['user'];
        $this->OTP = $data['OTP'];
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('MAIL_FROM_ADDRESS'), env('APP_NAME'))
            ->to($this->user->email, $this->user->name)
            ->subject('Reset Password Notification')
            ->markdown('emails.notifications.OPTPasswordResetMail')
            ->with([
                'settings'  => $this->settings,
                'OPT'       => $this->OTP
            ]);
    }
}
