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
            if (isset($request->photo)) {
                $user->photo = $request->photo;
            }
            if (isset($request->photo_name)) {
                $user->photo_name = $request->photo_name;
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
            ], 201);
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
