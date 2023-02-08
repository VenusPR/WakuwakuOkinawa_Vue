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
    public function bankTest(Request $request)
  {
      $user_id = 1;
      // $banks = Bank::where('user_id', $user_id)->first();
      // $banks = Bank::all();
      // $banks = User::all();
      $banks =  DB::select('select * from users limit 1;');
      // $banks = 'test';

      return ['banks' => $banks];
  }
}
