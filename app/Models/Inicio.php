<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inicio extends Model
{
  public function usuario(){
        return $this->belongsTo(User::class);
  }
  protected $guarded = [];



    use HasFactory;
}
