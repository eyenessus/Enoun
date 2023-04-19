<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use PhpParser\Node\Stmt\Return_;

class Categoria extends Model
{
    public function servico() : BelongsTo
    {
        return $this->belongsTo(Servico::class);
    }
    
    public function produtos() : BelongsToMany
    {
        return $this->belongsToMany(Produtos::class);
    }

    public function servicos() : BelongsToMany
    {
        return $this->belongsToMany(Servico::class);
    }
    
    use HasFactory;
    protected $fillable = ['nome'];
}
