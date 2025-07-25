<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Notificacion;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class NotificacionesSimpleWidget extends Widget
{
    protected static string $view = 'filament.employee.widgets.notificaciones-simple';

    protected static ?int $sort = 0; // Mostrar primero

    protected int | string | array $columnSpan = 'full';

    public function getNotificaciones()
    {
        return Notificacion::where('id_usuario', Auth::id())
            ->orderBy('fecha_envio', 'desc')
            ->limit(5)
            ->get();
    }

    public function getNotificacionesNoLeidas()
    {
        return Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->count();
    }
}
