<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{

    protected $casts  =
        [ 'inforextra' => 'array' ];


        public function usuario(){//singular
            //PERTEBCE A UM
            //relacao que tal servico pertence a um usuario 
            return $this->belongsTo('App\Models\User'); //pertence  a um
        }

        
        public function UsuariosPlus(){

        return $this->belongsToMany('App\Models\User');
        
        }

        public function pedidos(){
            return $this->belongsToMany('App\Models\Pedido');
        }
    protected $guarded = [];
    use HasFactory;
}
