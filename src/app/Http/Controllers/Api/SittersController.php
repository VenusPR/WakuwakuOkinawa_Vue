<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sitter;
use App\Models\Place;
use App\Models\Option;
use App\Models\User;
use Illuminate\Support\Facades\Storage;

class SittersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 1;
        $sitter = Sitter::with('place')->with('option')->where('user_id', $user_id)->first();
        return ["sitter" => $sitter];
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
        $sitter = Sitter::with('place')
            ->with('option')
            ->where('id', $id)
            ->where('state', 1)
            ->first();
        if (!$sitter) {
            return response()->json([
                'message' => 'ご指定のシッターサービスは存在しないか、未公開になっています。'
            ], 404);
        }
        return ["sitter" => $sitter];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $state 0:下書き 1:公開
     *
     * @return \Illuminate\Http\Response
     */
    public function saveSitter(Request $request, $state)
    {
        $user_id = 1;

        if ($request->sitter) {
            $sitter = Sitter::where('user_id', $user_id)->first();
            $sitter->state = $state;
            if (!$sitter) {//存在しない場合は新規作成
                //作成
                $sitter = new Sitter();
                $sitter->user_id = $user_id;
            }
            $this->setSitterUpdateProps($sitter, $request->sitter);

            $sitter->save();
            // Place(沖縄地域)の同期
            $place_array = array();
            if (isset($request->sitter['place'])) {
                foreach ($request->sitter['place'] as $place) {
                    array_push($place_array, $place['id']);
                }
                $sitter->place()->sync($place_array);
            }
        }

        $sitter = Sitter::with('place')->with('option')->where('user_id', $user_id)->first();
        return ["sitter" => $sitter];
    }
    /**
     * Sitterサービスのオプションの追加
     */
    public function addOption(Request $request)
    {
        $user_id = 1;
        $sitter = Sitter::where('user_id', $user_id)->first();
        $option = new Option();
        $option->sitter_id = $sitter->id;
        $option->save();
        $optionOne = Option::find($option->id);
        return ["option" => $optionOne];
    }

    /**
     * Sitterサービスのオプションの編集
     * すべてのオプションを一度に更新する
     */
    public function updateOption(Request $request)
    {
        $user_id = 1;
        $sitter = Sitter::where('user_id', $user_id)->first();
        if ($request->option) {
            foreach ($request->option as $optionData) {
                $option = null;
                if (isset($optionData['id'])) {
                    // 更新
                    $option = Option::where([['id', $optionData['id']], ['sitter_id', $sitter->id]])->first();
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
        $optionList = Option::where('sitter_id', $sitter->id)->get();
        return ["option" => $optionList];
    }

    /**
     * Sitterサービスのオプションの削除
     */
    public function deleteOption($id)
    {
        $user_id = 1;
        $sitter = Sitter::where('user_id', $user_id)->first();
        $option = Option::where('sitter_id', $sitter->id)->where('id', $id)->first();
        $option->delete();
        return ["message" => 'オプションを削除しました。'];
    }



    private function setSitterUpdateProps($sitter, $data)
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
            'childcare_min',
            'childcare_max',
            'min_support_hour'
        ];

        foreach ($updateProps as $prop) {
            if (!empty($data[$prop])) {
                $sitter->{$prop} = $data[$prop];
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
}
