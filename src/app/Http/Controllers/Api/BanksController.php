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
        return ["banks" => $banks];
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
            ], 400);
        }
        $bank = new Bank();
        $bank->user_id = $user_id;
        $bank->bank_name = $request->bank_name;
        $bank->branch_name = $request->branch_name;
        $bank->account_type = $request->account_type;
        $bank->account_number = $request->account_number;
        $bank->account_name = $request->account_name;
        $bank->save();

        return ['message' => 'created bank'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $bank = Bank::where('id', $id)->first();
        if (!$bank) {
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
        $bank = Bank::where('id', $id)->first();
        if (!$bank) {
            return response()->json([
                'message' => 'bank not found'
            ], 404);
        }
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

        return ['message' => 'updated bank info'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $bank = Bank::where('id', $id)->first();
        if (!$bank) {
            return response()->json([
                'message' => 'bank not found'
            ], 404);
        }
        $bank->delete();

        return ['message' => 'delete bank'];
    }
}
