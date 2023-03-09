<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Place;

class Sitter extends Model
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
        'childcare_min',
        'childcare_max',
        'min_support_hour',
        'option_id',
        'support_place_id',
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

    public function option()
    {
        return $this->hasMany(Option::class, 'sitter_id');
    }
}
