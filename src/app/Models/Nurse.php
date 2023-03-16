<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'state',
        'user_id',
        'title',
        'contents',
        'notes',
        'experience',
        'fee',
        'plus_fee',
        'acceptable_number',
        'min_support_hour',
        'start_pref_id',
        'photo_1',
        'photo_2',
        'photo_3',
        'photo_4',
        'photo_5'
    ];

    public function place()
    {
        return $this->belongsToMany(Place::class);
    }

    public function nurseOption()
    {
        return $this->hasMany(NurseOption::class, 'nurse_id');
    }
}
