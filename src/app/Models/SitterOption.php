<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SitterOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'sitter_id',
        'title',
        'fee',
    ];

    public function sitter()
    {
        return $this->belongsTo(Sitter::class);
    }
}
