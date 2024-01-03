<?php

namespace App\Http\Controllers\Auth;

use App\Models\ResetPassword;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ResetPasswordController extends Controller
{
    //
    public function resetForm(){
        return view('backend.auth.forgot');
    }

    public function submitForm(Request $request){
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);
        $passwordReset = new ResetPassword();

        // Set the attributes
        $passwordReset->email = $request->email;
        $passwordReset->token = $token;
        $passwordReset->created_at = Carbon::now();
       

        $passwordReset->save();
        
        Mail::send('backend.email.forgotPassword', ['token' => $token], function ($message) use ($request) {
            $message->to($request->email);
            $message->subject('Reset Password');
        });

        return back()->with('message', 'We have e-mailed your password reset link!');
    }
  
    public function showResetPasswordForm($token){
        return view('backend.auth.reset', ['token' => $token]);
    }

    public function passwordUpdate(Request $request){
        // dd($request->all());
        $request->validate([
            'email' => 'required|email|exists:users',
            'password' => 'required',
        ]);

        $updatePassword = ResetPassword::where('email', $request->email)
            ->where('token', $request->token)
            ->first();


        if (!$updatePassword) {
            return back()->withInput()->with('error', 'Invalid token!');
        }

        // Find the user by email
        $user = User::where('email', $request->email)->first();

      

        if ($user) {
            // Update the  password
            $user->password = Hash::make($request->password);
            $user->save();
        }

        ResetPassword::where('email', $request->email)->delete();

        Session::flash('cls', 'success');
        return redirect(route('dashboard'))->with('message', 'Your password has been changed!');
    }
}
