<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use App\Models\Producto;
use App\Models\User;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\DB;

class EstadisticasGeneralesWidget extends BaseWidget
{
    protected static ?int $sort = 1;

    protected function getStats(): array
    {
        // Pedidos de hoy
        $pedidosHoy = Pedido::whereDate('created_at', today())->count();

        // Ventas de hoy
        $ventasHoy = Pedido::whereDate('created_at', today())
            ->where('estado', '!=', 'cancelado')
            ->sum('total');

        // Total usuarios
        $totalUsuarios = User::count();

        // Productos con stock bajo (menos de 10)
        $stockBajo = Producto::where('stock', '<', 10)
            ->where('estado', 'activo')
            ->count();

        return [
            Stat::make('Pedidos Hoy', $pedidosHoy)
                ->description('Pedidos realizados hoy')
                ->descriptionIcon('heroicon-o-shopping-bag')
                ->color('primary')
                ->chart([7, 4, 8, 12, 15, 10, $pedidosHoy]),

            Stat::make('Ventas del Día', 'Bs ' . number_format($ventasHoy, 2, '.', ','))
                ->description('Ingresos de hoy (Bolivianos)')
                ->descriptionIcon('heroicon-o-banknotes')
                ->color('success')
                ->chart([200, 180, 250, 300, 280, 350, $ventasHoy]),

            Stat::make('Total Usuarios', $totalUsuarios)
                ->description('Usuarios registrados')
                ->descriptionIcon('heroicon-o-users')
                ->color('info')
                ->chart([50, 55, 60, 65, 70, 75, $totalUsuarios]),

            Stat::make('Stock Bajo', $stockBajo)
                ->description('Productos con poco stock')
                ->descriptionIcon('heroicon-o-exclamation-triangle')
                ->color($stockBajo > 0 ? 'warning' : 'success')
                ->chart([2, 3, 1, 0, 2, 4, $stockBajo]),
        ];
    }
}
