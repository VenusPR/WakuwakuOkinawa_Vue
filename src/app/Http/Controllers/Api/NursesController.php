<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Nurse;
use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\NurseOption;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class NursesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 1;
        $nurse = Nurse::with('place')->with('nurseOption')->where('user_id', $user_id)->first();
        return ["nurse" => $nurse];
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
    public function show($id)
    {
        $nurse = Nurse::with('place')
            ->with('nurseOption')
            ->where('id', $id)
            ->where('state', 1)
            ->first();
        if (!$nurse) {
            return response()->json([
                'message' => 'ご指定の付き添いサービスは存在しないか、未公開になっています。'
            ], 404);
        }
        return ["nurse" => $nurse];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $state 0:下書き 1:公開
     *
     * @return \Illuminate\Http\Response
     */
    public function saveNurse(Request $request, $state)
    {
        $user_id = 1;

        if ($request->nurse) {
            $nurse = Nurse::where('user_id', $user_id)->first();
            $nurse->state = $state;
            if (!$nurse) { //存在しない場合は新規作成
                //作成
                $nurse = new Nurse();
                $nurse->user_id = $user_id;
            }
            $this->setNurseUpdateProps($nurse, $request->nurse);

            $nurse->save();

            //Place(沖縄地域)の同期
            $place_array = array();
            if (isset($request->nurse['place'])) {
                foreach ($request->nurse['place'] as $place) {
                    array_push($place_array, $place['id']);
                }
                $nurse->place()->sync($place_array);
            }
        }

        $nurse = Nurse::with('place')->with('nurseOption')->where('user_id', $user_id)->first();
        return ["nurse" => $nurse];
    }
    /**
     * Nurseサービスのオプションの追加
     */
    public function addOption(Request $request)
    {
        $user_id = 1;
        $nurse = Nurse::where('user_id', $user_id)->first();
        $option = new NurseOption();
        $option->nurse_id = $nurse->id;
        $option->save();
        $optionOne = NurseOption::find($option->id);
        return ["option" => $optionOne];
    }
    /**
     * Nurseサービスのオプションの編集
     * すべてのオプションを一度に更新する
     */
    public function updateOption(Request $request)
    {
        $user_id = 1;
        $nurse = Nurse::where('user_id', $user_id)->first();
        if ($request->option) {
            foreach ($request->option as $optionData) {
                $option = null;
                if (isset($optionData['id'])) {
                    //更新
                    $option = NurseOption::where([['id', $optionData['id']], ['nurse_id', $nurse->id]])->first();
                    if (!$option) {
                        return response()->json([
                            'message' => 'option not found'
                        ], 404);
                    }
                    $this->setOptionUpdateProps($option, $optionData);
                }
                $option->save();
            }
        }
        $optionList = NurseOption::where('sitter_id', $nurse->id)->get();
        return ["option" => $optionList];
    }

    /**
     * Sitterサービスのオプションの削除
     */
    public function deleteOption($id)
    {
        $user_id = 1;
        $nurse = Nurse::where('user_id', $user_id)->first();
        $option = NurseOption::where('nurse_id', $nurse->id)->where('id', $id)->first();
        $option->delete();
        return ["message" => 'オプションを削除しました。'];
    }


    private function setNurseUpdateProps($nurse, $data)
    {
        $updateProps = [
            'state',
            'user_id',
            'title',
            'contents',
            'notes',
            'experience',
            'fee',
            'plus_fee',
            'acceptable_number',
            'min_support_hour',
            'start_pref_id',
        ];

        foreach ($updateProps as $prop) {
            if (!empty($data[$prop])) {
                $nurse->{$prop} = $data[$prop];
            }
        }
    }

    private function setOptionUpdateProps($option, $data)
    {
        $updateProps = [
            'title',
            'fee',
        ];

        foreach ($updateProps as $prop) {
            if (!empty($data[$prop])) {
                $option->{$prop} = $data[$prop];
            }
        }
    }

    public function uploadPhotos(Request $request)
    {
        // ユーザー自身が変更するとき
        $this->validate($request, [
            'file_*' => [
                // 必須
                'required',
                // アップロードされたファイルであること
                'file',
                // 画像ファイルであること
                'image',
                // MIMEタイプを指定
                'mimes:jpeg,png,jpg',
                // 容量
                'max:2048',
            ]
        ]);

        $user_id = 1;
        $nurse = Nurse::where('user_id', $user_id)->first();

        // バリデーションチェック
        for ($i = 1; $i <= 5; $i++) {
            $file = $request->file("file_$i");
            if ($request->hasFile("file_$i")) {
                if (!$file->isValid()) {
                    return response()->json([
                        'message' => "failed to upload image $i"
                    ], 400);
                }
            }
        }

        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("file_$i")) {
                $file = $request->file("file_$i");
                $path = $file->store("public/nurses_photo/$nurse->id");
                $file_name = '/storage/nurses_photo/' . $nurse->id . '/' . basename($path);
                //既存のファイルがある場合は削除する
                if ($nurse->{"photo_$i"}) {
                    Storage::disk('public')->delete($nurse->{"photo_$i"});
                }
                $nurse->{"photo_$i"} = $file_name;
            }
        }

        $nurse->save();

        return [
            'message' => 'Images uploaded successfully',
            'file_names' => [
                $nurse->photo_1,
                $nurse->photo_2,
                $nurse->photo_3,
                $nurse->photo_4,
                $nurse->photo_5,
            ]
        ];
    }
}
