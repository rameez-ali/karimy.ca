<?php
   
namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;
  
class ChangePasswordController
{
   
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required'],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        $changepass = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_password)]);
        
        if($changepass){
          return response()->json([
            'message' => 'Password Changed Successfully Done',
            'status'  => 1
          ], 200);
        } else {
          return response()->json([
            'message' => 'Password failed to change',
            'status'  => 0
          ], 200);
        }
    }
}