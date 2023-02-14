<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Bank;

class BanksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_id = 1;
        $banks = Bank::where('user_id', $user_id)->get();
        return $banks;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * * bank_name
     * branch_name
     * account_type
     * account_number
     * account_name
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user_id = 1;

        if (Bank::where('user_id', $user_id)->exists()) {
            return response()->json([
                'message' => 'already exists bank'
            ], 201);
        } else {
            $bank = new Bank();
            $bank->user_id = $user_id;
            $bank->bank_name = $request->bank_name;
            $bank->branch_name = $request->branch_name;
            $bank->account_type = $request->account_type;
            $bank->account_number = $request->account_number;
            $bank->account_name = $request->account_name;
            $bank->save();

            return response()->json([
                'message' => 'created bank'
            ], 201);
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
        if (Bank::where('id', $id)->exists()) {
            $bank = Bank::find($id);
        } else {
            return response()->json([
                'message' => 'bank not found'
            ], 404);
        }
        return $bank;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * 
     * * bank_name
     * branch_name
     * account_type
     * account_number
     * account_name
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        // $user_id = 1;
        if (Bank::where('id', $id)->exists()) {
            $bank = Bank::find($id);
            if (!empty($request->bank_name)) {
                $bank->bank_name = $request->bank_name;
            }
            if (!empty($request->branch_name)) {
                $bank->branch_name = $request->branch_name;
            }
            if (isset($request->account_type)) {
                $bank->account_type = $request->account_type;
            }
            if (isset($request->account_number)) {
                $bank->account_number = $request->account_number;
            }
            if (isset($request->account_name)) {
                $bank->account_name = $request->account_name;
            }
            $bank->save();

            return response()->json([
                'message' => 'updated bank info'
            ], 201);
        } else {
            return response()->json([
                'message' => 'bank not found'
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
        if (Bank::where('id', $id)->exists()) {
            $bank = Bank::find($id);
            $bank->delete();

            return response()->json([
                'message' => 'delete bank'
            ], 202);
        } else {
            return response()->json([
                'message' => 'bank not found'
            ], 404);
        }
    }
}
