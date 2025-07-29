<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Producto;
use Filament\Widgets\Widget;

class StockBajoWidget extends Widget
{
    protected static string $view = 'filament.admin.widgets.stock-bajo-widget';

    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    public function getProductosStockBajo()
    {
        return Producto::where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->orderBy('stock', 'asc')
            ->limit(10)
            ->get();
    }

    public function getProductosSinStock()
    {
        return Producto::where('stock', 0)
            ->orderBy('nombre', 'asc')
            ->limit(10)
            ->get();
    }

    public function getTotalProductosStockBajo()
    {
        return Producto::where('stock', '<=', 5)
            ->where('stock', '>', 0)
            ->count();
    }

    public function getTotalProductosSinStock()
    {
        return Producto::where('stock', 0)->count();
    }

    public function getTotalProductos()
    {
        return Producto::count();
    }

    public function getPorcentajeStockBajo()
    {
        $total = $this->getTotalProductos();
        $stockBajo = $this->getTotalProductosStockBajo() + $this->getTotalProductosSinStock();
        
        if ($total === 0) return 0;
        
        return round(($stockBajo / $total) * 100, 1);
    }
} 