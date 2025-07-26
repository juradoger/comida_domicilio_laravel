<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Pedido;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use Illuminate\Support\Facades\Auth;

class PedidosStatsWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $empleadoId = Auth::id();

        return [
            Stat::make('Pedidos Pendientes', Pedido::where('estado', 'pendiente')->where('id_empleado', $empleadoId)->count())
                ->description('Pedidos por procesar')
                ->descriptionIcon('heroicon-m-clock')
                ->color('warning'),

            Stat::make('Aceptado', Pedido::where('estado', 'aceptado')->where('id_empleado', $empleadoId)->count())
                ->description('Pedidos siendo preparados')
                ->descriptionIcon('heroicon-m-cog-6-tooth')
                ->color('info'),

            Stat::make('En Camino', Pedido::where('estado', 'en_camino')->where('id_empleado', $empleadoId)->count())
                ->description('Pedidos en ruta de entrega')
                ->descriptionIcon('heroicon-m-truck')
                ->color('primary'),

            Stat::make('Entregados Hoy', Pedido::where('estado', 'entregado')->where('id_empleado', $empleadoId)->whereDate('updated_at', today())->count())
                ->description('Completados hoy')
                ->descriptionIcon('heroicon-m-check-circle')
                ->color('success'),
        ];
    }
}
