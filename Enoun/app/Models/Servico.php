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

    use HasFactory;
}
