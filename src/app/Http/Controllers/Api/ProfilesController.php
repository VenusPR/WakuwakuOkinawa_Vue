<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfilesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(String $me)
    {
        $user_id = 1;
        if ($me != 'me') {
            return response()->json([
                'message' => 'can not access'
            ], 400);
        }
        $users = User::with('prefecture')->find($user_id);
        // $users = User::find($user_id)->prefecture;
        return $users;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * email
     * last_name
     * first_name
     * last_kana
     * first_kana
     * birthday
     * sex 1:女性、2：男性、3:指定しない
     * zipcode
     * prefecture_id prefectureテーブルとリレーション 1対1
     * city
     * street
     * building
     * tel
     * nearest_station
     * self_intro
     * photo_name
     * emergency_contact_name
     * emergency_contact_relation
     * emergency_contact_tel
     */
    public function update(Request $request, String $me)
    {
        $user_id = 1;
        if ($me != 'me') {
            return response()->json([
                'message' => 'can not access'
            ], 400);
        }
        $user = User::where('id', $user_id)->first();
        if (!$user) {
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }
        if (!empty($request->email)) {
            $user->email = $request->email;
        }
        if (!empty($request->last_name)) {
            $user->last_name = $request->last_name;
        }
        if (isset($request->first_name)) {
            $user->first_name = $request->first_name;
        }
        if (isset($request->last_kana)) {
            $user->last_kana = $request->last_kana;
        }
        if (isset($request->first_kana)) {
            $user->first_kana = $request->first_kana;
        }
        if (isset($request->birthday)) {
            $user->birthday = $request->birthday;
        }
        if (isset($request->sex)) {
            $user->sex = $request->sex;
        }
        if (isset($request->zipcode)) {
            $user->zipcode = $request->zipcode;
        }
        if (isset($request->prefecture_id)) {
            $user->prefecture_id = $request->prefecture_id;
        }
        if (isset($request->city)) {
            $user->city = $request->city;
        }
        if (isset($request->street)) {
            $user->street = $request->street;
        }
        if (isset($request->building)) {
            $user->building = $request->building;
        }
        if (isset($request->tel)) {
            $user->tel = $request->tel;
        }
        if (isset($request->nearest_station)) {
            $user->nearest_station = $request->nearest_station;
        }
        if (isset($request->self_intro)) {
            $user->self_intro = $request->self_intro;
        }
        if (isset($request->emergency_contact_name)) {
            $user->emergency_contact_name = $request->emergency_contact_name;
        }
        if (isset($request->emergency_contact_relation)) {
            $user->emergency_contact_relation = $request->emergency_contact_relation;
        }
        if (isset($request->emergency_contact_tel)) {
            $user->emergency_contact_tel = $request->emergency_contact_tel;
        }

        $user->save();

        return response()->json([
            'message' => 'updated user info'
        ], 200);
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

    /**
     * 画像ファイルのアップロード
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request)
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

        if (!$request->file('file')->isValid([])) {
            return response()->json([
                'message' => 'failed to upload image'
            ], 400);
        }
        // dd($request->file('file'));
        if (empty($request->file('file'))) {
            return response()->json([
                'message' => '画像が選択されていません'
            ], 400);
        }
        $path = $request->file->store('public/photo');
        // $user = Auth::user();
        $user = User::find($user_id);
        $file_name = basename($path);
        //ファイルがある場合
        if ($user->photo_name) {
            //ファイルの削除
            Storage::disk('public')->delete($user->photo_name);
        }

        // $user->photo = $file_path;
        $user->photo_name = $file_name;

        $user->save();

        return response()->json([
            'message' => 'Image uploaded successfully',
            'file_name' => 'storage/photo' . $file_name
        ], 200);
    }
}
