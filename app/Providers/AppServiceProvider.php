<?php

namespace App\Providers;



use App\Repositories\UserEloquentORM;
use App\Repositories\UserEnounInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

     $this->app->bind(UserEnounInterface::class,UserEloquentORM::class);
     
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // 
    }
}
