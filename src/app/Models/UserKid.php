<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserKid extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_name',
        'first_name',
        'last_kana',
        'first_kana',
        'birthday',
        'sex',
        'allergy',
        'other_notes',
        'photo_name',
    ];
}
