<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserSenior;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class ProfilesSeniorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user_id = 1;
        $seniors = UserSenior::where('user_id', $user_id)->get();
        return ["seniors" => $seniors];
    }

    /**
     * Save seniros in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function saveSeniors(Request $request)
    {
        $user_id = 1;

        // ユーザに紐づくすべてのseniorsの作成、更新、削除を行います。
        if ($request->seniors) {
            foreach ($request->seniors as $seniorData) {
                $senior = null;
                if (isset($seniorData['id'])) {
                    // 更新
                    $senior = UserSenior::where([['id', $seniorData['id']], ['user_id', $user_id]])->first();
                    if (!$senior) {
                        return response()->json([
                            'message' => 'senior not found'
                        ], 404);
                    }
                    $this->setSeniorUpdateProps($senior, $seniorData);
                } else {
                    // 作成
                    $senior = new UserSenior();
                    $senior->user_id = $user_id;
                    $this->setSeniorUpdateProps($senior, $seniorData);
                }

                $senior->save();
            }
        }

        // 削除
        if ($request->delete_senior_ids) {
            foreach ($request->delete_senior_ids as $senior_id) {
                $senior = UserSenior::where([['id', $senior_id], ['user_id', $user_id]])->first();
                if (!$senior) {
                    return response()->json([
                        'message' => 'senior not found'
                    ], 404);
                }
                $senior->delete();
            }
        }


        $seniors = UserSenior::where('user_id', $user_id)->get();
        return ['seniors' => $seniors];
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
        $path = $request->file->store('public/profile/seniors_photo');
        // $user = Auth::user();
        $senior = UserSenior::where('id', $id)->first();
        $file_name = '/storage/profile/seniors_photo/' . basename($path);
        //ファイルがある場合
        if ($senior->photo_name) {
            //ファイルの削除
            Storage::disk('public')->delete($senior->photo_name);
        }

        // $user->photo = $file_path;
        $senior->photo_name = $file_name;

        $senior->save();

        return [
            'message' => 'Image uploaded successfully',
            'file_name' => $file_name
        ];
    }

    private function setSeniorUpdateProps($senior, $data)
    {
        if (!empty($data['last_name'])) {
            $senior->last_name = $data['last_name'];
        }
        if (!empty($data['first_name'])) {
            $senior->first_name = $data['first_name'];
        }
        if (!empty($data['last_kana'])) {
            $senior->last_kana = $data['last_kana'];
        }
        if (!empty($data['first_kana'])) {
            $senior->first_kana = $data['first_kana'];
        }
        if (!empty($data['birthday'])) {
            $senior->birthday = $data['birthday'];
        }
        if (!empty($data['sex'])) {
            $senior->sex = $data['sex'];
        }
        if (!empty($data['allergy'])) {
            $senior->allergy = $data['allergy'];
        }
        if (!empty($data['other_notes'])) {
            $senior->other_notes = $data['other_notes'];
        }
        if (!empty($data['tel'])) {
            $senior->tel = $data['tel'];
        }
    }
}
