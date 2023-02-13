<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    public function usuario(){
        return $this->belongsTo('\App\Models\User');
    } 

    protected $fillable =
     [
        'user_id',
        'nome'
    ];
    protected $casts = 
    [
        'descricao' => 'array'
    ];

    use HasFactory;
}
