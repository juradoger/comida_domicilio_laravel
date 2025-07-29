<?php

namespace App\Filament\Pages;

use App\Filament\Widgets\EstadisticasGeneralesWidget;
use App\Filament\Widgets\PedidosPorMesWidget;
use App\Filament\Widgets\EstadoPedidosWidget;
use App\Filament\Widgets\ProductosMasVendidosWidget;
use App\Filament\Widgets\IngresosMensualesWidget;
use App\Filament\Admin\Widgets\StockBajoWidget;
use App\Filament\Admin\Widgets\NotificacionesBandejaWidget;
use App\Filament\Admin\Widgets\NotificacionesWidget;
use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationLabel = 'Panel de Control';
    protected static ?string $title = 'Panel de Control';
    protected static string $routePath = '/';

    public function getWidgets(): array
    {
        return [
            StockBajoWidget::class,
            NotificacionesBandejaWidget::class,
            NotificacionesWidget::class,
            EstadisticasGeneralesWidget::class,
            PedidosPorMesWidget::class,
            EstadoPedidosWidget::class,
            IngresosMensualesWidget::class,
            ProductosMasVendidosWidget::class,
        ];
    }

    public function getColumns(): int | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 3,
            'xl' => 4,
        ];
    }
}
