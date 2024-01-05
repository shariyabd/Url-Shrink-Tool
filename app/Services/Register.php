<?php
namespace App\Services;
use App\Models\User;
use App\Models\UserVerify;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class Register{
    public function store(array $data):User{
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token = Str::random(64);
        UserVerify::create([
            'user_id' => $user['id'],
            'token' => $token
        ]);

        Mail::send('backend.email.emailVerification', ['token' => $token], function ($message) use ($data) {
            $message->to($data['email']);
            $message->subject('Email Verification Mail');
        });
        return $user;
        
    }
}




?>