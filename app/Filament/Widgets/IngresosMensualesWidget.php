<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class IngresosMensualesWidget extends ChartWidget
{
    protected static ?string $heading = 'Ingresos Mensuales';
    protected static ?int $sort = 6;

    protected function getData(): array
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL
            $data = Pedido::select(
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
                DB::raw('SUM(total) as total_ingresos')
            )
                ->whereYear('created_at', date('Y'))
                ->where('estado', '!=', 'cancelado')
                ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
                ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
                ->get();
        } else {
            // MySQL
            $data = Pedido::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total) as total_ingresos')
            )
                ->whereYear('created_at', date('Y'))
                ->where('estado', '!=', 'cancelado')
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }
        $months = [
            1 => 'Ene',
            2 => 'Feb',
            3 => 'Mar',
            4 => 'Abr',
            5 => 'May',
            6 => 'Jun',
            7 => 'Jul',
            8 => 'Ago',
            9 => 'Sep',
            10 => 'Oct',
            11 => 'Nov',
            12 => 'Dic'
        ];

        $chartData = [];
        $labels = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i];
            $found = $data->firstWhere('month', $i);
            $chartData[] = $found ? (float) $found->total_ingresos : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Ingresos (COP)',
                    'data' => $chartData,
                    'backgroundColor' => 'rgba(34, 197, 94, 0.2)',
                    'borderColor' => 'rgb(34, 197, 94)',
                    'borderWidth' => 3,
                    'fill' => true,
                    'tension' => 0.4,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }

    protected function getOptions(): array
    {
        return [
            'plugins' => [
                'legend' => [
                    'display' => true,
                ],
            ],
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'callback' => 'function(value) { return "$" + value.toLocaleString(); }',
                    ],
                ],
            ],
        ];
    }
}
