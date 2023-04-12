<?php

namespace App\Providers;



use App\Repositories\Produto\ProdutoEloquentORM;
use App\Repositories\Produto\ProdutoEnounInterface;
use App\Repositories\Servico\ServicoEloquentORM;
use App\Repositories\Servico\ServicoEnounInterface;
use App\Repositories\User\UserEloquentORM;
use App\Repositories\User\UserEnounInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     $this->app->bind(UserEnounInterface::class,UserEloquentORM::class);
     $this->app->bind(ProdutoEnounInterface::class,ProdutoEloquentORM::class);
     $this->app->bind(ServicoEnounInterface::class,ServicoEloquentORM::class);

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // 
    }
}
