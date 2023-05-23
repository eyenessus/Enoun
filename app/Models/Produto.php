<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


class Produto extends Model
{
    public function user() : BelongsTo
    {
      return $this->belongsTo(User::class);
    }

    public function users() : BelongsToMany
    {
       return $this->belongsToMany(User::class);
    }


    public function categoria() : BelongsTo
    {
        return $this->BelongsTo(Categoria::class);
        
    }

    

    use HasFactory;

    protected $fillable = ['nome', 'codigo','valor','imagem','categoria_id','descricao','user_id','marca'];
}
