<?php
namespace App\Services;


class Login{
    public function store(array $data)
    {
        $credentials = [
            'email' => $data['email'],
            'password' => $data['password'],
        ];

        return $credentials;
    }
}




?>