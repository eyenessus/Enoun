<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }


    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillable = [
        'descricao',
        'status',
        'quantidadeUnitaria',
        'valorUnitario',
        'user_id',
        'valorTotal',
        'nome',
    ];

    protected $casts = [
        'descricao' => 'array',
        'nome'=>'array',
        'quantidadeUnitaria' => 'array',
        'valorUnitario' => 'array'
    ];
    
    use HasFactory;
}
