<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    public function usuarios(){
        return $this->belongsToMany(User::class);
    }
   
    protected $fillable = ['user_id'];

    protected $casts = ['descricao'=> 'array'];
}
