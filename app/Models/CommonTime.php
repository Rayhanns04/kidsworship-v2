<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommonTime extends Model
{
    use HasFactory;

    public function AllAsset() {
        return $this->belongsTo(AllAsset::class);
    }
}
