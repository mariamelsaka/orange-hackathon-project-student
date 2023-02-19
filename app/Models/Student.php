<?php

namespace App\Models;

use App\Models\Enroll;

use App\Models\Revision;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{

    use HasApiTokens, HasFactory, Notifiable;

    //protected string $guard = 'admin';
    protected $table = 'students';
    protected $fillable = [
        'username','name','password','phone_number','address','email','image_id','gender_id',
    ];


    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function student(){
        return $this->hasMany(Enroll::class,'student_id');
        return $this->hasMany(Revision::class,'revision_id');
    }







}
