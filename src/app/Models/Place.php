<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Sitter;

class Place extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'code',
        'name',
    ];

    public function sitter()
    {
        return $this->belongsToMany(Sitter::class);
    }
}
