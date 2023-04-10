<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use User;

class Servico extends Model
{
    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function users() : BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function pedido() : belongsToMany 
    {
        return $this->belongsToMany(Pedido::class);
    }

    public function categoria() : BelongsTo
    {
        return $this->BelongsTo(Categoria::class);
    }


 
    protected $fillable = ['nome', 'codigo','valor','imagem','categoria_id','descricao'];
    use HasFactory;
}
