<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Children extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = ['email', 'fullname', 'password', 'old', 'number_child', 'graybeard_id'];

    public function Graybeard()
    {
        return $this->belongsTo(Graybeard::class);
    }

    public function Prayers()
    {
        return $this->hasMany(Prayer::class);
    }
}
