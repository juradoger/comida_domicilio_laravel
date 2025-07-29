<?php

namespace App\Filament\Employee\Widgets;

use App\Models\Notificacion;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\Auth;

class NotificacionesWidget extends Widget
{
    protected static string $view = 'filament.employee.widgets.notificaciones-widget';

    protected static ?int $sort = 1;

    protected static bool $isLazy = false;

    protected int | string | array $columnSpan = 'full';

    protected $listeners = [
        'notificacion-marcada' => '$refresh',
        'todas-notificaciones-marcadas' => '$refresh',
    ];

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

            // Emitir evento para refrescar el widget
            $this->dispatch('notificacion-marcada');

            // Notificación de éxito
            \Filament\Notifications\Notification::make()
                ->title('Notificación marcada como leída')
                ->success()
                ->send();
        }
    }

    public function marcarTodasComoLeidas()
    {
        $cantidad = Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->count();

        if ($cantidad > 0) {
            Notificacion::where('id_usuario', Auth::id())
                ->where('leido', false)
                ->update(['leido' => true]);

            // Emitir evento para refrescar el widget
            $this->dispatch('todas-notificaciones-marcadas');

            // Notificación de éxito
            \Filament\Notifications\Notification::make()
                ->title("$cantidad notificaciones marcadas como leídas")
                ->success()
                ->send();
        }
    }
}
