<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Cupom;
use App\Models\Endereco;
use App\Models\Noticia;
use App\Models\Pedido;
use App\Models\Produto;
use App\Models\Servico;
use App\Models\Slide;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nome',
        'email',
        'sobrenome',
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
        return $this->hasMany(Noticia::class);
    }


    public function slides(): HasMany
    {
        return $this->hasMany(Slide::class);
    }


    public function pedidos(): HasMany
    {
        return $this->hasMany(Pedido::class);
    }


    public function servicos(): HasMany
    {
        return $this->hasMany(Servico::class);
    }


    public function produtos(): HasMany
    {
      return $this->hasMany(Produto::class);
    }
   

    public function produtosComCarrinho(): BelongsToMany
    {
        return $this->belongsToMany(Produto::class)->withPivot('quantidade');
    }


    public function servicosComCarrinho(): BelongsToMany
    {
        return $this->belongsToMany(Servico::class)->withPivot('quantidade');
    }

    public function identidade() : hasOne
    {
        return $this->hasOne(Identidade::class);
    }

    public function produtosCarrinho(): MorphToMany
    {
        return $this->morphedByMany(Produto::class, 'carrinho')->withPivot('quantidade');
    }
    public function servicosCarrinho(): MorphToMany
    {
        return $this->morphedByMany(Servico::class, 'carrinho')->withPivot('quantidade');
    }
    
    public function cupons(): BelongsToMany
    {
        return $this->belongsToMany(Cupom::class);
    }
    
     /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
}
