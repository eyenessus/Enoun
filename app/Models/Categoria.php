<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Categoria extends Model
{
    public function servico() : BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }
    
    use HasFactory;
}
