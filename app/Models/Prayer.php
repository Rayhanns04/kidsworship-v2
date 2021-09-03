<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Prayer extends Model
{
    use HasFactory, HasApiTokens;

    public function commonTime() {
        return $this->belongsTo(CommonTime::class, 'common_time_id', 'id');
    }

    public function Children() {
        return $this->belongsTo(Children::class);
    }
}
