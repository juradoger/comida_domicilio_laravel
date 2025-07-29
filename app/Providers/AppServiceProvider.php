<?php

namespace App\Providers;

use App\Models\Pedido;
use App\Models\Producto;
use App\Observers\PedidoObserver;
use App\Observers\ProductoObserver;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;

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
        Model::unguard();

        // Registrar el observador de pedidos
        Pedido::observe(PedidoObserver::class);
        
        // Registrar el observador de productos
        Producto::observe(ProductoObserver::class);
    }
}
