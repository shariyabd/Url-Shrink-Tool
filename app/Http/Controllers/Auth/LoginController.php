<?php

namespace App\Http\Controllers\Auth;

use App\Services\Login;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function create()
    {
        return view('backend.auth.login');
    }

    public function store(LoginRequest $request, Login $login)
    {
        $validatedData = $request->validated();
        $user = $login->store($validatedData);
        if (auth()->attempt($user)) {
            return redirect('/dashboard')->with('success', 'Great! You have successfully logged in.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Email or Password does not match our records.');
        }
    }
}
