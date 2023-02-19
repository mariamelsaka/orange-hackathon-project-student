<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

//use Illuminate\Foundation\Auth\User as Authenticatable;


class Admin extends Model
{
    //use HasFactory;
    use HasApiTokens, HasFactory, Notifiable;


    use Notifiable;


    protected $fillable = [
        'username','name','password','phone_number','address','email','image_id','gender_id','role',
        'is_head',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
