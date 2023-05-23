<?php

namespace App\Models;

use App\Models\Produto;
use App\Models\Servico;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

class Carrinho extends Model
{
   
    protected $fillable = ['user_id', 'quantidade'];
    use HasFactory;
}
