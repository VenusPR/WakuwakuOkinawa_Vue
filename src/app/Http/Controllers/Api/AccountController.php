<?php

namespace App\Http\Controllers\Api;
// namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bank;
use App\Models\User;

class AccountController extends Controller
{

    public function banks(Request $request)
    {
        $user_id = 1;
        $banks = Bank::where('user_id', $user_id)->get();
        return $banks;
    }

  /**
   * 個人のすべての口座を参照
   */
    public function allBanks(Request $request)
  {
      $user_id = 1;
      $banks = Bank::where('user_id', $user_id)->get();
      return response()->json($banks,200,[],JSON_UNESCAPED_UNICODE);
  }

  /**
   * 個人のすべての口座を参照
   */
  // public function xgetBanks(Request $request, int $id)
  // {
  //    $user_id = 1;
  //    if(empty($id)){//idがない場合はすべての口座を返す
  //     if (Bank::where('user_id', $user_id)->exists()){
  //       $banks = Bank::where('user_id', $user_id)->get();
  //       return response()->json($banks,200,[],JSON_UNESCAPED_UNICODE);
  //     }else {
  //         return response()->json([
  //             'message' => 'this user is bank not found'
  //         ], 404);
  //     }
  //    }elseif(!empty($id)){//idがある場合は一つの口座を返す
  //     if (Bank::where('user_id', $user_id)->where('id', $id)->exists()){
  //       $bank = Bank::find($id);
  //     }else {
  //       return response()->json([
  //           'message' => 'this user is bank not found(one)'
  //       ], 404);
  //   }
  //     return response()->json($bank,200,[],JSON_UNESCAPED_UNICODE);
  //    }
     
  // }

  /**
   * 個人の一つ口座を参照
   */
  public function oneBank(Request $request, int $id)
  {
      if (Bank::where('id', $id)->exists()){
        $bank = Bank::find($id);
      }else {
        return response()->json([
            'message' => 'bank not found'
        ], 404);
    }
      return response()->json($bank,200,[],JSON_UNESCAPED_UNICODE);
  }


  /**
   * 個人の口座を変更
   * @request
   * bank_name
   * branch_name
   * account_type
   * account_number
   * account_name
   */
    public function updateBank(Request $request, int $id)
  {
    $user_id = 1;
    if (Bank::where('id', $id)->exists())
        {
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
   * 個人の口座を追加
   * @request
   * bank_name
   * branch_name
   * account_type
   * account_number
   * account_name
   */
  public function createBank(Request $request)
    {
      $user_id = 1;
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

    /**
     * 個人の口座の削除
     */
    public function destoryBank(Request $request, int $id)
    {
      // return ['test' => $id];
        if (Bank::where('id', $id)->exists())
        {
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
