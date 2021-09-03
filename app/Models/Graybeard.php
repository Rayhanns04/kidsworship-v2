<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;

class Graybeard extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['email', 'fullname', 'password', 'created_at'];


    public function Childrens()
    {
        return $this->hasMany(Children::class);
    }

    public function Prayers()
    {
        return $this->hasManyThrough(Prayer::class, Children::class);
    }
}
