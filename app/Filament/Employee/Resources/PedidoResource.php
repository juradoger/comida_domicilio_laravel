<?php

namespace App\Filament\Employee\Resources;

use App\Filament\Employee\Resources\PedidoResource\Pages;
use App\Filament\Employee\Resources\PedidoResource\RelationManagers;
use App\Models\Pedido;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;

class PedidoResource extends Resource
{
    protected static ?string $model = Pedido::class;

    protected static ?string $navigationIcon = 'heroicon-o-shopping-bag';

    protected static ?string $navigationLabel = 'Pedidos';

    protected static ?string $modelLabel = 'Pedido';

    protected static ?string $pluralModelLabel = 'Pedidos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('id_usuario')
                    ->relationship('usuario', 'name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->label('Cliente'),
                Forms\Components\TextInput::make('empleado_asignado')
                    ->default(Auth::user()->name)
                    ->disabled()
                    ->label('Empleado Asignado'),
                Forms\Components\Hidden::make('id_empleado')
                    ->default(Auth::id()),
                Forms\Components\TextInput::make('total')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->label('Total'),
                Forms\Components\TextInput::make('subtotal')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->label('Subtotal'),
                Forms\Components\TextInput::make('costo_envio')
                    ->required()
                    ->numeric()
                    ->prefix('$')
                    ->label('Costo de Envío'),
                Forms\Components\DateTimePicker::make('fecha_entrega')
                    ->required()
                    ->label('Fecha de Entrega'),
                Forms\Components\Select::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_preparacion' => 'En Preparación',
                        'en_camino' => 'En Camino',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->required()
                    ->default('pendiente')
                    ->label('Estado'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),
                Tables\Columns\TextColumn::make('usuario.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('empleado_nombre')
                    ->label('Empleado')
                    ->getStateUsing(fn($record) => Auth::user()->name)
                    ->badge()
                    ->color('info'),
                Tables\Columns\TextColumn::make('total')
                    ->money('USD')
                    ->sortable()
                    ->label('Total'),
                Tables\Columns\BadgeColumn::make('estado')
                    ->colors([
                        'secondary' => 'pendiente',
                        'warning' => 'en_preparacion',
                        'primary' => 'en_camino',
                        'success' => 'entregado',
                        'danger' => 'cancelado',
                    ])
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'pendiente' => 'Pendiente',
                        'en_preparacion' => 'En Preparación',
                        'en_camino' => 'En Camino',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                        default => $state,
                    })
                    ->label('Estado'),
                Tables\Columns\TextColumn::make('fecha_entrega')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->label('Fecha de Entrega'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i')
                    ->sortable()
                    ->label('Creado')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_preparacion' => 'En Preparación',
                        'en_camino' => 'En Camino',
                        'entregado' => 'Entregado',
                        'cancelado' => 'Cancelado',
                    ])
                    ->label('Estado'),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\Action::make('ver_cliente')
                        ->label('Ver Cliente')
                        ->icon('heroicon-o-user')
                        ->color('info')
                        ->modalHeading(fn(Pedido $record) => 'Información del Cliente - Pedido #' . $record->id)
                        ->modalContent(fn(Pedido $record) => view('filament.employee.modals.cliente-info', ['pedido' => $record]))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Cerrar')
                        ->modalWidth('4xl'),

                    Tables\Actions\Action::make('ver_pedido')
                        ->label('Ver Detalles del Pedido')
                        ->icon('heroicon-o-shopping-cart')
                        ->color('success')
                        ->modalHeading(fn(Pedido $record) => 'Detalles del Pedido #' . $record->id)
                        ->modalContent(fn(Pedido $record) => view('filament.employee.modals.pedido-detalles', ['pedido' => $record]))
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Cerrar')
                        ->modalWidth('5xl'),

                    Tables\Actions\Action::make('cambiar_estado')
                        ->label('Cambiar Estado')
                        ->icon('heroicon-o-arrow-path')
                        ->color('warning')
                        ->form([
                            Forms\Components\Select::make('estado')
                                ->options([
                                    'pendiente' => 'Pendiente',
                                    'en_preparacion' => 'En Preparación',
                                    'en_camino' => 'En Camino',
                                    'entregado' => 'Entregado',
                                    'cancelado' => 'Cancelado',
                                ])
                                ->required()
                                ->default(fn(Pedido $record) => $record->estado),
                        ])
                        ->action(function (array $data, Pedido $record): void {
                            $record->update(['estado' => $data['estado']]);
                        })
                        ->successNotificationTitle('Estado actualizado correctamente'),
                ])
                    ->label('Acciones')
                    ->icon('heroicon-m-ellipsis-vertical')
                    ->size('sm')
                    ->color('gray')
                    ->button(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('id_empleado', Auth::id());
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPedidos::route('/'),
            'create' => Pages\CreatePedido::route('/create'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
