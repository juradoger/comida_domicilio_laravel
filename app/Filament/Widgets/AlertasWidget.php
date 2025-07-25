<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use App\Models\Producto;
use Filament\Widgets\Widget;

class AlertasWidget extends Widget
{
    protected static string $view = 'filament.widgets.alertas-widget';
    protected static ?int $sort = 0;
    protected int | string | array $columnSpan = 'full';

    public function getViewData(): array
    {
        $pedidosPendientes = Pedido::where('estado', 'pendiente')->count();
        $productosStockBajo = Producto::where('stock', '<', 10)
            ->where('estado', 'activo')
            ->count();
        $pedidosAtrasados = Pedido::where('estado', 'en_camino')
            ->where('fecha_entrega', '<', now())
            ->count();

        return [
            'pedidos_pendientes' => $pedidosPendientes,
            'productos_stock_bajo' => $productosStockBajo,
            'pedidos_atrasados' => $pedidosAtrasados,
        ];
    }
}
