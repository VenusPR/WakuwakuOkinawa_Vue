<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function fooBar(Request $request)
    {
        $token = '123';
        return ['test' => $token, 'config' => config('database')];
    }

    public function fooBarTest(Request $request)
    {
        // $token = 'abc';
        // $token =  User::all();
        $token =  DB::select('select * from users limit 1;');
        return ['test' => $token];
    }
}
