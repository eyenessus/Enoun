<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Pedido extends Model
{
    use HasFactory;

    public function usuarios() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    protected $fillable = ['user_id'];

    protected $casts = [
        'descricao' => 'array',
        'quantidadeUnitaria' => 'array',
        'valorUnitario' => 'array'
];
}
