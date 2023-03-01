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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = 1;

        if (UserSenior::where('user_id', $user_id)->count() > 1) {
            return response()->json([
                'message' => 'すでに２人登録されています'
            ], 400);
        }

        $seniors = new UserSenior();
        $seniors->user_id = $user_id;
        $seniors->last_name = $request->last_name;
        $seniors->first_name = $request->first_name;
        $seniors->last_kana = $request->last_kana;
        $seniors->first_kana = $request->first_kana;
        $seniors->birthday = $request->birthday;
        $seniors->sex = $request->sex;
        $seniors->allergy = $request->allergy;
        $seniors->other_notes = $request->other_notes;
        $seniors->tel = $request->tel;
        $seniors->save();

        return ['message' => 'created senior'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $senior = UserSenior::where('id', $id)->first();
        if (!$senior) {
            return response()->json([
                'message' => 'senior not found'
            ], 404);
        }
        return $senior;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     * last_name
     * first_name
     * last_kana
     * first_kana
     * birthday
     * sex
     * allergy
     * other_notes
     * tel
     */
    public function update(Request $request, $id)
    {
        $senior = UserSenior::where('id', $id)->first();
        if (!$senior) {
            return response()->json([
                'message' => 'senior not found'
            ], 404);
        }
        if (!empty($request->last_name)) {
            $senior->last_name = $request->last_name;
        }
        if (!empty($request->first_name)) {
            $senior->first_name = $request->first_name;
        }
        if (!empty($request->last_kana)) {
            $senior->last_kana = $request->last_kana;
        }
        if (!empty($request->first_kana)) {
            $senior->first_kana = $request->first_kana;
        }
        if (!empty($request->birthday)) {
            $senior->birthday = $request->birthday;
        }
        if (!empty($request->sex)) {
            $senior->sex = $request->sex;
        }
        if (!empty($request->allergy)) {
            $senior->allergy = $request->allergy;
        }
        if (!empty($request->other_notes)) {
            $senior->other_notes = $request->other_notes;
        }
        if (!empty($request->tel)) {
            $senior->tel = $request->tel;
        }
        $senior->save();

        return ['message' => 'updated senior info'];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function multiUpdate(Request $request)
    {
        // $seniorsData = json_decode($request->getContent(), true);
        $seniorsData = $request->seniors;
        foreach ($seniorsData as $seniorData) {
            $senior = UserSenior::where('id', $seniorData['id'])->first();
            // dd($seniorData);
            if (!$senior) {
                    return response()->json([
                        'message' => 'Senior not found'
                    ], 404);
            }
            if (!empty($seniorData['last_name'])) {
                $senior->last_name = $seniorData['last_name'];
            }
            if (!empty($seniorData['first_name'])) {
                $senior->first_name = $seniorData['first_name'];
            }
            if (!empty($seniorData['last_kana'])) {
                $senior->last_kana = $seniorData['last_kana'];
            }
            if (!empty($seniorData['first_kana'])) {
                $senior->first_kana = $seniorData['first_kana'];
            }
            if (!empty($seniorData['birthday'])) {
                $senior->birthday = $seniorData['birthday'];
            }
            if (!empty($seniorData['sex'])) {
                $senior->sex = $seniorData['sex'];
            }
            if (!empty($seniorData['allergy'])) {
                $senior->allergy = $seniorData['allergy'];
            }
            if (!empty($seniorData['other_notes'])) {
                $senior->other_notes = $seniorData['other_notes'];
            }
            if (!empty($seniorData['tel'])) {
                $senior->tel = $seniorData['tel'];
            }
            $senior->save();
        }

        return ['message' => 'updated senior info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $senior = UserSenior::where('id', $id)->first();
        if (!$senior) {
            return response()->json([
                'message' => 'senior not found'
            ], 404);
        }
        $senior->delete();

        return ['message' => 'delete senior'];
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
}
