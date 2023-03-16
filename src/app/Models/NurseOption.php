<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NurseOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'nurse_id',
        'title',
        'fee',
    ];

    public function nurse()
    {
        return $this->belongsTo(Nurse::class);
    }
}
