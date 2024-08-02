<?php

namespace App\Services\Auth;

use App\Models\User;
use App\Mail\WelcomeMail;
use App\Jobs\SendWelcomeEmail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class AuthService
{
    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function register(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return ['success' => false, 'errors' => $validator->errors()];
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        SendWelcomeEmail::dispatch($user);

        return ['success' => true, 'user' => $user];
    }
}
