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
        $user_id = 1;
        $users = User::with('prefecture')->find($user_id);
        // $users = User::find($user_id)->prefecture;
        return $users;
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
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
    public function update(Request $request, int $id)
    {
        $user_id = 1;
        if (User::where('id', $id)->exists()) {
            $user = User::find($id);
            $user->email = $request->email;
            $user->last_name = $request->last_name;
            $user->first_name = $request->first_name;
            $user->last_kana = $request->last_kana;
            $user->first_kana = $request->first_kana;
            $user->birthday = $request->birthday;
            $user->sex = $request->sex;
            $user->zipcode = $request->zipcode;
            $user->prefecture_id = $request->prefecture_id;
            $user->city = $request->city;
            $user->street = $request->street;
            $user->building = $request->building;
            $user->tel = $request->tel;
            $user->nearest_station = $request->nearest_station;
            $user->self_intro = $request->self_intro;
            $user->photo = $request->photo;
            $user->photo_name = $request->photo_name;
            $user->emergency_contact_name = $request->emergency_contact_name;
            $user->emergency_contact_relation = $request->emergency_contact_relation;
            $user->emergency_contact_tel = $request->emergency_contact_tel;

            $user->save();

            return response()->json([
                'message' => 'updated user info'
            ], 200);
        } else {
            return response()->json([
                'message' => 'user not found'
            ], 404);
        }
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
