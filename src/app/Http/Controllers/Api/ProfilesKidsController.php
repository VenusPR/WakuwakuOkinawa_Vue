<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserKid;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class ProfilesKidsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 1;

        $kids = UserKid::where('user_id', $user_id)->get();
        return ["kids" => $kids];
    }

    /**
     * Save kids in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveKids(Request $request)
    {
        $user_id = 1;

        // この処理は、ユーザに紐づくすべてのkidsの作成、更新、削除を行います。
        foreach ($request->kids as $kidData) {
            $kid = null;
            if ($kidData['id']) {
                // 更新
                $kid = UserKid::where([['id', $kidData['id']], ['user_id', $user_id]])->first();
                if (!$kid) {
                        return response()->json([
                            'message' => 'kid not found'
                        ], 404);
                }
                $this->setKidUpdateProps($kid, $kidData);
            } else {
                // 作成
                $kid = new UserKid();
                $kid->user_id = $user_id;
                $this->setKidUpdateProps($kid, $kidData);
            }

            $kid->save();
        }

        // 削除
        foreach ($request->delete_kid_ids as $kid_id) {
            $kid = UserKid::where([['id', $kid_id], ['user_id', $user_id]])->first();
            if ($kid) {
                // 画像ファイルがある場合、削除する
                if ($kid->photo_name) {
                    //ファイルの削除
                    Storage::disk('public')->delete($kid->photo_name);
                }

                $kid->delete();
            }
        }

        $kids = UserKid::where('user_id', $user_id)->get();
        return ['kids' => $kids];
    }

    /**
     * 画像ファイルのアップロード
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatePhoto(Request $request, int $id)
    {

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
        $path = $request->file->store('public/profile/kids_photo');
        // $user = Auth::user();
        $kid = UserKid::where('id', $id)->first();
        $file_name = '/storage/profile/kids_photo/' . basename($path);
        //ファイルがある場合
        if ($kid->photo_name) {
            //ファイルの削除
            Storage::disk('public')->delete($kid->photo_name);
        }

        // $user->photo = $file_path;
        $kid->photo_name = $file_name;

        $kid->save();

        return [
            'message' => 'Image uploaded successfully',
            'file_name' => $file_name
        ];
    }

    private function setKidUpdateProps($kid, $data)
    {
        if (!empty($data['last_name'])) {
            $kid->last_name = $data['last_name'];
        }
        if (!empty($data['first_name'])) {
            $kid->first_name = $data['first_name'];
        }
        if (!empty($data['last_kana'])) {
            $kid->last_kana = $data['last_kana'];
        }
        if (!empty($data['first_kana'])) {
            $kid->first_kana = $data['first_kana'];
        }
        if (!empty($data['birthday'])) {
            $kid->birthday = $data['birthday'];
        }
        if (!empty($data['sex'])) {
            $kid->sex = $data['sex'];
        }
        if (!empty($data['allergy'])) {
            $kid->allergy = $data['allergy'];
        }
        if (!empty($data['other_notes'])) {
            $kid->other_notes = $data['other_notes'];
        }
    }
}
