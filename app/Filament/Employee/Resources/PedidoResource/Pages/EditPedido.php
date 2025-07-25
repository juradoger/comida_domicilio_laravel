<?php

namespace App\Filament\Employee\Resources\PedidoResource\Pages;

use App\Filament\Employee\Resources\PedidoResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPedido extends EditRecord
{
    protected static string $resource = PedidoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
