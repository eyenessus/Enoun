<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{

    public function usuario(){
        $this->belongsTo('App\Models\Servico\User');
    }

    use HasFactory;
}
