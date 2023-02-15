<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ImagesController extends Controller
{
    /**
     * 画像ファイルの取得
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 1;
        $file_name = User::find($user_id)->select('photo_name')->first();
        return response()->file(Storage::path("public/" . $file_name['photo_name']));
    }

    /**
     * 画像ファイルのアップロード
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = 1;
        //ユーザー自身が変更するとき
        $this->validate($request, [
            'file' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file', //postmanではkeyをこれにすること！
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png,jpg',
                // 容量
                'max:2048',
            ]
        ]);

        if ($request->file('file')->isValid([])) {
            $path = $request->file->store('public');
            // $user = Auth::user();
            $user = User::find($user_id);
            $file_name = basename($path);
            //ファイルの削除
            Storage::disk('public')->delete($user->photo_name);
            // $user->photo = $file_path;
            $user->photo_name = $file_name;

            $user->save();

            return response()->json([
                'message' => 'successfully upload image'
            ], 200);
        } else {
            return response()->json([
                'message' => 'donot upload image'
            ], 404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
