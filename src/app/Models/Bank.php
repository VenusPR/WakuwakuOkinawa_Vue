<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    use HasFactory;

    protected $fillable = [
        'no',
        'state',
        'trash_user_id',
        'user_id',
        'bank_name',
        'branch_name',
        'account_type',
        'account_number',
        'account_name',
    ];
}
