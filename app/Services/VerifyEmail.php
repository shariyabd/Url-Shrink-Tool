<?php

namespace App\Services;

use App\Models\UserVerify;

class VerifyEmail{
    public function verifyAccount($token){
        $verifyUser = UserVerify::where('token', $token)->first();
        if(!is_null($verifyUser) ){
            $user = $verifyUser->user;
              
            if(!$user->is_email_verified) {
                $verifyUser->user->is_email_verified = 1;
                $verifyUser->user->save();
            } 
        }
  
        return   $verifyUser;
    }
}











?>