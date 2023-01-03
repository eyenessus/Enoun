<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $fillable = [
        "nome",
        "sobrenome",
        "email",
        "senha",
        "user",
        "endereco",
        "cidade",
        "estado",
        'cep'
    ];
    
    use HasFactory;
    
}
