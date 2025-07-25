<?php

namespace App\Filament\Widgets;

use App\Models\Pedido;
use Filament\Widgets\ChartWidget;
use Illuminate\Support\Facades\DB;

class PedidosPorMesWidget extends ChartWidget
{
    protected static ?string $heading = 'Pedidos por Mes';
    protected static ?int $sort = 2;

    protected function getData(): array
    {
        $driver = DB::connection()->getDriverName();

        if ($driver === 'pgsql') {
            // PostgreSQL
            $data = Pedido::select(
                DB::raw('EXTRACT(MONTH FROM created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
                ->whereYear('created_at', date('Y'))
                ->groupBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
                ->orderBy(DB::raw('EXTRACT(MONTH FROM created_at)'))
                ->get();
        } else {
            // MySQL
            $data = Pedido::select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as count')
            )
                ->whereYear('created_at', date('Y'))
                ->groupBy('month')
                ->orderBy('month')
                ->get();
        }
        $months = [
            1 => 'Enero',
            2 => 'Febrero',
            3 => 'Marzo',
            4 => 'Abril',
            5 => 'Mayo',
            6 => 'Junio',
            7 => 'Julio',
            8 => 'Agosto',
            9 => 'Septiembre',
            10 => 'Octubre',
            11 => 'Noviembre',
            12 => 'Diciembre'
        ];

        $chartData = [];
        $labels = [];

        for ($i = 1; $i <= 12; $i++) {
            $labels[] = $months[$i];
            $found = $data->firstWhere('month', $i);
            $chartData[] = $found ? $found->count : 0;
        }

        return [
            'datasets' => [
                [
                    'label' => 'Pedidos',
                    'data' => $chartData,
                    'backgroundColor' => 'rgba(59, 130, 246, 0.1)',
                    'borderColor' => 'rgb(59, 130, 246)',
                    'borderWidth' => 2,
                    'fill' => true,
                ],
            ],
            'labels' => $labels,
        ];
    }

    protected function getType(): string
    {
        return 'line';
    }
}
