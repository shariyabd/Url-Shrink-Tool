<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserVerify;
use App\Services\Register;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\VerifyEmail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Session;

class RegisterController extends Controller
{
    public function create()
    {
        return view('backend.auth.register');
    
    }

    public function store(RegisterRequest $request, Register $register)
{
    $validatedData = $request->validated();

    $user = $register->store($validatedData);
    if($user) {
        return redirect()->back()->with('message', 'We have sent you a link to your email for verification. Please check!');
    }
}



     public function verifyAccount($token, VerifyEmail $verifyEmail)
    {
    $verify = $verifyEmail->verifyAccount($token);
        if($verify){

            return redirect()->route('login')->with('message', "Your e-mail is verified. You can now login.");
        }else{
            return redirect()->route('register')->with('message', "Sorry your email cannot be identified.");
        }
    }

}
