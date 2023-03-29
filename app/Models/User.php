<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

   
    public function endereco(): HasOne
    {
        return $this->hasOne(Endereco::class);
    }


    public function noticias(): HasMany
    {
        return $this->hasMany(Noticias::class);
    }


    public function slides(): HasMany
    {
        return $this->hasMany(Slides::class);
    }


    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedidos::class);
    }


    public function servicos(): HasMany
    {
        return $this->hasMany(Servico::class);
    }


    public function produtos(): HasMany
    {
        return $this->hasMany(Produto::class);
    }
   

    public function pedidosAsWith(): BelongsToMany
    {
        return $this->belongsToMany(Pedidos::class);
    }


    public function produtosAsWith(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class);
    }


    public function servicosAsWith(): BelongsToMany
    {
        return $this->belongsToMany(Servico::class);
    }
}
