<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function fooBar(Request $request)
    {
        $token = '123';
        return ['test' => $token];
    }
}
