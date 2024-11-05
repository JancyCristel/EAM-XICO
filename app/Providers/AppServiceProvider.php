<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\Categoria;



class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Verificar si no se está ejecutando un comando de Artisan y si la tabla 'categorias' existe
        if (!app()->runningInConsole() && Schema::hasTable('categorias')) {
            $categorias = Categoria::all();
            View::share('categorias', $categorias);
        }
    }
}

