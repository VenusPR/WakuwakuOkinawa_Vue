<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'last_name',
        'created_at',
        'updated_at',
        'state',
        'trash_user_id',
        'first_name',
        'last_kana',
        'first_kana',
        'last_login_at',
        'api_token',
        'identification',
        'birthday',
        'sex',
        'zipcode',
        'prefecture_id',
        'city',
        'street',
        'building',
        'tel',
        'nearest_station',
        'self_intro',
        'photo',
        'photo_name',
        'emergency_contact_name',
        'emergency_contact_relation',
        'emergency_contact_tel'
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function prefecture()
    {
        return $this->belongsTo('App\Models\Prefecture');
    }
}
