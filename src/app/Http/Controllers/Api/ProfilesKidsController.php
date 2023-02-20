<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\UserKid;

class ProfilesKidsController extends Controller
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
        $kids = UserKid::where('user_id', $user_id)->get();
        return ["kids" => $kids];
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

        if (UserKid::where('user_id', $user_id)->count() > 2) {
            return response()->json([
                'message' => 'すでに３人登録されています'
            ], 400);
        }
        $kid = new UserKid();
        $kid->user_id = $user_id;
        $kid->last_name = $request->last_name;
        $kid->first_name = $request->first_name;
        $kid->last_kana = $request->last_kana;
        $kid->first_kana = $request->first_kana;
        $kid->birthday = $request->birthday;
        $kid->sex = $request->sex;
        $kid->allergy = $request->allergy;
        $kid->other_notes = $request->other_notes;
        $kid->save();

        return response()->json([
            'message' => 'created kid'
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $kid = UserKid::where('id', $id)->first();
        if (!$kid) {
            return response()->json([
                'message' => 'kid not found'
            ], 404);
        }
        return $kid;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // $user_id = 1;
        $kid = UserKid::where('id', $id)->first();
        if (!$kid) {
            return response()->json([
                'message' => 'kid not found'
            ], 404);
        }
        if (!empty($request->last_name)) {
            $kid->last_name = $request->last_name;
        }
        if (!empty($request->first_name)) {
            $kid->first_name = $request->first_name;
        }
        if (!empty($request->last_kana)) {
            $kid->last_kana = $request->last_kana;
        }
        if (!empty($request->first_kana)) {
            $kid->first_kana = $request->first_kana;
        }
        if (!empty($request->birthday)) {
            $kid->birthday = $request->birthday;
        }
        if (!empty($request->sex)) {
            $kid->sex = $request->sex;
        }
        if (!empty($request->allergy)) {
            $kid->allergy = $request->allergy;
        }
        if (!empty($request->other_notes)) {
            $kid->other_notes = $request->other_notes;
        }
        $kid->save();

        return response()->json([
            'message' => 'updated kid info'
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
        $kid = UserKid::where('id', $id)->first();
        if (!$kid) {
            return response()->json([
                'message' => 'kid not found'
            ], 404);
        }
        $kid->delete();

        return response()->json([
            'message' => 'delete kid'
        ], 200);
    }
}
