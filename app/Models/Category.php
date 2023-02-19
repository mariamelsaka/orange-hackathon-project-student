<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Category extends Model
{
    use HasApiTokens, HasFactory, Notifiable;



    public function course(){
        return $this->hasMany(Course::class,'course_id');

    }

    protected $table='categories';
    protected $fillable = [
       'category_name','created_at','updated_at'

    ];
}
