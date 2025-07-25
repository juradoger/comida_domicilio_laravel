<?php

namespace App\Filament\Employee\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $navigationIcon = 'heroicon-o-home';

    protected static string $view = '';

    public function getTitle(): string
    {
        return 'Panel de Empleados - Dashboard';
    }

    public function getHeading(): string
    {
        return 'Bienvenido al Panel de Empleados';
    }

    public function getSubheading(): string | null
    {
        return 'Gestiona los pedidos y operaciones diarias';
    }
}
