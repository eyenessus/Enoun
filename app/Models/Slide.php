<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    public function usuario(){
        return $this->belongsTo(User::class);
    }

    use HasFactory;
}
