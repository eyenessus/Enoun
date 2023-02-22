<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Servico extends Model
{

    protected $casts  =
    ['inforextra' => 'array'];


    public function usuario() : BelongsTo
    { //singular
        //PERTEBCE A UM
        //relacao que tal servico pertence a um usuario 
        return $this->belongsTo(User::class); //pertence  a um
    }


    public function UsuariosPlus() : BelongsToMany
    {

        return $this->belongsToMany(User::class);
    }

    public function pedidos() : BelongsToMany
    {
        return $this->belongsToMany(Pedido::class);
    }
    protected $guarded = [];
    use HasFactory;
}
