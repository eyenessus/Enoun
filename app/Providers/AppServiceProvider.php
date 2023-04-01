<?php

namespace App\Providers;



use App\Repositories\EnounEloquentORM;
use App\Repositories\EnounRepositoryInterface;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
     
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
       // 
    }
}
