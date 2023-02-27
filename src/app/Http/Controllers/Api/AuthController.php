<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\User;

class AuthController extends Controller
{
    public function verify(Request $request)
    {
        $token = $request->token;

        $auth = Firebase::project('app')->auth();
        try {
            // verify
            $verifiedToken = $auth->verifyIdToken($token);
            $claims = $verifiedToken->claims();
            $firebase_user_id = $claims->get('user_id');
            $email = $claims->get('email');

            // find user
            $user = User::where('firebase_user_id', $firebase_user_id)->first();
            if (!$user) {
                // create user
                $user = new User();
                $user->firebase_user_id = $firebase_user_id;
                $user->email = $email;
                $user->password = '';
                $user->save();
            }

            $user_token = $user->createToken('auth_token')->plainTextToken;
            return ['user' => $user, 'user_token' => $user_token];
        } catch (\Exception $e) {
            Log::warning('Failed to verify token. ' . $e->getMessage());

            // Note: 本当はFrontへ情報を返さないほうがセキュリティ上よいけれど、
            // エラー情報が合ったほうがデバッグしやすいので、メッセージを追加
            return response()->json([
                'message' => "Failed to verify token.". $e->getMessage()
            ], 401);
        }
    }

    public function getUser(Request $request)
    {
        // ログイン済みのユーザーを取得
        $user = $request->user();
        return ["user" => $user];
    }
}
