<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PedidoResource\Pages;
use App\Filament\Resources\PedidoResource\RelationManagers;
use App\Models\Pedido;
use App\Models\User;
use App\Models\Empleado;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DateTimePicker;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

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
                Select::make('id_usuario')
                    ->label('Cliente')
                    ->relationship('usuario', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('id_empleado')
                    ->label('Empleado Repartidor')
                    ->relationship('empleado.usuario', 'name')
                    ->searchable()
                    ->preload()
                    ->nullable(),

                TextInput::make('subtotal')
                    ->label('Subtotal')
                    ->numeric()
                    ->prefix('$')
                    ->required(),

                TextInput::make('costo_envio')
                    ->label('Costo de Envío')
                    ->numeric()
                    ->prefix('$')
                    ->required(),

                TextInput::make('total')
                    ->label('Total')
                    ->numeric()
                    ->prefix('$')
                    ->required(),

                DateTimePicker::make('fecha_entrega')
                    ->label('Fecha de Entrega')
                    ->required(),

                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_camino' => 'En Camino',
                        'entregado' => 'Entregado',
                    ])
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('usuario.name')
                    ->label('Cliente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('empleado.usuario.name')
                    ->label('Repartidor')
                    ->searchable()
                    ->placeholder('Sin asignar'),

                TextColumn::make('total')
                    ->label('Total')
                    ->money('COP')
                    ->sortable(),

                TextColumn::make('fecha_entrega')
                    ->label('Fecha Entrega')
                    ->dateTime()
                    ->sortable(),

                BadgeColumn::make('estado')
                    ->label('Estado')
                    ->colors([
                        'warning' => 'pendiente',
                        'primary' => 'en_camino',
                        'success' => 'entregado',
                    ])
                    ->icons([
                        'heroicon-s-clock' => 'pendiente',
                        'heroicon-s-truck' => 'en_camino',
                        'heroicon-s-check-circle' => 'entregado',
                    ]),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'pendiente' => 'Pendiente',
                        'en_camino' => 'En Camino',
                        'entregado' => 'Entregado',
                    ]),

                SelectFilter::make('id_empleado')
                    ->label('Repartidor')
                    ->relationship('empleado.usuario', 'name')
                    ->searchable()
                    ->preload(),

                Filter::make('fecha_entrega')
                    ->form([
                        DateTimePicker::make('entrega_desde')
                            ->label('Entrega desde'),
                        DateTimePicker::make('entrega_hasta')
                            ->label('Entrega hasta'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['entrega_desde'],
                                fn(Builder $query, $date): Builder => $query->whereDate('fecha_entrega', '>=', $date),
                            )
                            ->when(
                                $data['entrega_hasta'],
                                fn(Builder $query, $date): Builder => $query->whereDate('fecha_entrega', '<=', $date),
                            );
                    }),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
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
            //     'view' => Pages\ViewPedido::route('/{record}'),
            'edit' => Pages\EditPedido::route('/{record}/edit'),
        ];
    }
}
