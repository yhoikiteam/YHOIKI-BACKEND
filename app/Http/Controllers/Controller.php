<?php

namespace App\Http\Controllers;

abstract class Controller
{
    protected function generateToken()
    {
        $token = substr(str_shuffle('0123456789'), 0, 6);
        return $token;
    }
    protected function FA2_code()
    {
        $token = substr(str_shuffle('0123456789'), 0, 6);
        return $token;
    }
}
