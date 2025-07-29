<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Calificacion;
use App\Models\Empleado;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class CalificacionesWidget extends Widget
{
    protected static string $view = 'filament.employee.widgets.calificaciones-widget';

    protected static ?int $sort = 2;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    public function getCalificaciones()
    {
        return Calificacion::where('id_empleado', Auth::id())
            ->with(['pedido', 'usuario'])
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
    }

    public function getCalificacionPromedio()
    {
        $empleado = Empleado::where('id_usuario', Auth::id())->first();
        return $empleado ? $empleado->calificacion_promedio : 0;
    }

    public function getTotalCalificaciones()
    {
        return Calificacion::where('id_empleado', Auth::id())->count();
    }

    public function getCalificacionesRecientes()
    {
        return Calificacion::where('id_empleado', Auth::id())
            ->where('created_at', '>=', now()->subDays(30))
            ->count();
    }
} 