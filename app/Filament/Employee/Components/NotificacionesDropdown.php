<?php

namespace App\Filament\Employee\Components;

use App\Models\Notificacion;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class NotificacionesDropdown extends Component
{
    public $mostrarDropdown = false;

    public function mount()
    {
        // Inicializar
    }

    public function toggleDropdown()
    {
        $this->mostrarDropdown = !$this->mostrarDropdown;
    }

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

        $this->dispatch('notificacion-actualizada');
    }

    public function marcarTodasComoLeidas()
    {
        Notificacion::where('id_usuario', Auth::id())
            ->where('leido', false)
            ->update(['leido' => true]);

        $this->dispatch('notificaciones-actualizadas');
    }

    public function render()
    {
        return view('filament.employee.components.notificaciones-dropdown');
    }
}
