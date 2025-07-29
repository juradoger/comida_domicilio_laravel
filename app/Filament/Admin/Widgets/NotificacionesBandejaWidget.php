<?php

namespace App\Filament\Admin\Widgets;

use App\Models\Notificacion;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class NotificacionesBandejaWidget extends Widget
{
    protected static string $view = 'filament.admin.widgets.notificaciones-bandeja-widget';

    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    public function getNotificaciones()
    {
        return Notificacion::where('id_usuario', Auth::id())
            ->orderBy('fecha_envio', 'desc')
            ->limit(10)
            ->get();
    }

    public function getNotificacionesNoLeidas()
    {
        return Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->count();
    }

    public function marcarComoLeida($id)
    {
        $notificacion = Notificacion::where('id', $id)
            ->where('id_usuario', Auth::id())
            ->first();

        if ($notificacion) {
            $notificacion->update(['leido' => true]);
        }

        $this->dispatch('notificacion-marcada');
    }

    public function marcarTodasComoLeidas()
    {
        Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->update(['leido' => true]);

        $this->dispatch('todas-notificaciones-marcadas');
    }

    public function getNotificacionesPorTipo()
    {
        return Notificacion::where('id_usuario', Auth::id())
            ->selectRaw('tipo, COUNT(*) as cantidad')
            ->groupBy('tipo')
            ->get();
    }
} 