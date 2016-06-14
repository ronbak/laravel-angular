<?php
/**
 * Created by PhpStorm.
 * User: Raylan
 * Date: 14/06/2016
 * Time: 12:28
 */

namespace LaravelAngular\OAuth;

use Illuminate\Support\Facades\Auth;

class Verifier
{
    public function verify($username, $password)
    {
        $credentials = [
            'email'    => $username,
            'password' => $password,
        ];

        if (Auth::once($credentials)) {
            return Auth::user()->id;
        }

        return false;
    }
}