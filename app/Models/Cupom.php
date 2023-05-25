<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Cupom extends Model
{
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
    use HasFactory;
}
