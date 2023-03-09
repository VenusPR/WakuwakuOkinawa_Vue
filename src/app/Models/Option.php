<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'fee',
    ];

    public function sitter()
    {
        return $this->belongsTo(Sitter::class);
    }
}
