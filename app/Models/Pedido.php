<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    public function usuario(){
        return $this->belongsTo('\App\Models\User');
    } 

    public function usuariosPedido(){
        return $this->belongsToMany('\App\Models\User');
    }

    protected $fillable = 
    [
        'user_id'
    ];
    protected $casts = [
        'servico_id' => 'array'
    ];
    use HasFactory;
}
