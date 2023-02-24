<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Slide extends Model
{
    public function usuario() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    protected $guarded = [];

    use HasFactory;
}
