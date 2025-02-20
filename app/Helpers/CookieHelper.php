<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Cookie;

class CookieHelper
{
    public function setLogin($login, $password, $remember)
    {
        $data = json_encode([
            'login' => $login,
            'password' => $password,
        ]);

        if ($remember) {
            Cookie::queue('data', $data, 10000);
        } else {
            Cookie::queue('data', $data, 300);
        }
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        $data = request()->cookie('data');
        $json = json_decode($data, true);

        return $json['login'];
    }

    public function removeLogin()
    {
        Cookie::queue(Cookie::forget('data'));
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        $data = request()->cookie('data');
        $json = json_decode($data, true);

        return $json['password'];
    }
}
