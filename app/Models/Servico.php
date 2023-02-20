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
            return $this->belongsTo(User::class); //pertence  a um
        }

        
        public function UsuariosPlus(){

        return $this->belongsToMany(User::class);
        
        }

        public function pedidos(){
            return $this->belongsToMany(Pedido::class);
        }
    protected $guarded = [];
    use HasFactory;
}
