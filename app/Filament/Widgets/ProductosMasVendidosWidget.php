<?php

namespace App\Filament\Widgets;

use App\Models\Detalle_pedido;
use App\Models\Producto;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class ProductosMasVendidosWidget extends ChartWidget
{
    protected static ?string $heading = 'Productos Más Vendidos';
    protected static ?int $sort = 4;

    protected function getData(): array
    {
        $data = Detalle_pedido::select(
            'productos.nombre',
            DB::raw('SUM(detalle_pedidos.cantidad) as total_vendido')
        )
            ->join('productos', 'detalle_pedidos.id_producto', '=', 'productos.id')
            ->groupBy('detalle_pedidos.id_producto', 'productos.nombre')
            ->orderBy('total_vendido', 'desc')
            ->limit(10)
            ->get();

        $labels = $data->pluck('nombre')->toArray();
        $values = $data->pluck('total_vendido')->toArray();

        return [
            'datasets' => [
                [
                    'label' => 'Cantidad Vendida',
                    'data' => $values,
                    'backgroundColor' => [
                        '#ef4444',
                        '#f97316',
                        '#f59e0b',
                        '#eab308',
                        '#84cc16',
                        '#22c55e',
                        '#10b981',
                        '#14b8a6',
                        '#06b6d4',
                        '#0ea5e9'
                    ],
                    'borderWidth' => 0,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'bar';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                ],
            ],
        ];
    }
}
