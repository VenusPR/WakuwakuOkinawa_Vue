<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;

class DebugController extends Controller
{
    public function configs(Request $request, string $name = null)
    {
        if ($name) {
            return [config($name)];
        } else {
            return [config('database')];
        }
    }

    public function user1(Request $request)
    {
        $users = DB::select('select * from users where id = ?', [1]);
        return $users;
    }
}
