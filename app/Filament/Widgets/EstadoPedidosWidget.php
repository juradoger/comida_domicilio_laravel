<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class EstadoPedidosWidget extends ChartWidget
{
    protected static ?string $heading = 'Estado de Pedidos';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        $data = Pedido::select('estado', DB::raw('COUNT(*) as count'))
            ->groupBy('estado')
            ->get();

        $colors = [
            'pendiente' => '#f59e0b',
            'confirmado' => '#3b82f6',
            'en_preparacion' => '#8b5cf6',
            'en_camino' => '#06b6d4',
            'entregado' => '#10b981',
            'cancelado' => '#ef4444',
        ];

        $backgroundColors = [];
        $labels = [];
        $values = [];

        foreach ($data as $item) {
            $labels[] = ucfirst(str_replace('_', ' ', $item->estado));
            $values[] = $item->count;
            $backgroundColors[] = $colors[$item->estado] ?? '#6b7280';
        }

        return [
            'datasets' => [
                [
                    'data' => $values,
                    'backgroundColor' => $backgroundColors,
                    'borderWidth' => 0,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'doughnut';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                    'position' => 'bottom',
                ],
            ],
        ];
    }
}
