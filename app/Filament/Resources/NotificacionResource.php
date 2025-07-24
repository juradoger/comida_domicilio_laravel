<?php

namespace App\Filament\Resources;

use App\Filament\Resources\NotificacionResource\Pages;
use App\Filament\Resources\NotificacionResource\RelationManagers;
use App\Models\Notificacion;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NotificacionResource extends Resource
{
    protected static ?string $model = Notificacion::class;

    protected static ?string $navigationIcon = 'heroicon-o-bell';

    protected static ?string $navigationLabel = 'Notificaciones';

    protected static ?string $modelLabel = 'Notificación';

    protected static ?string $pluralModelLabel = 'Notificaciones';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Select::make('id_usuario')
                    ->label('Usuario')
                    ->relationship('usuario', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('mensaje')
                    ->label('Mensaje')
                    ->required()
                    ->rows(3)
                    ->maxLength(1000),

                DateTimePicker::make('fecha_envio')
                    ->label('Fecha de Envío')
                    ->required()
                    ->default(now()),

                Toggle::make('leido')
                    ->label('Leído')
                    ->default(false),
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
                    ->label('Usuario')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('mensaje')
                    ->label('Mensaje')
                    ->limit(50)
                    ->searchable(),

                TextColumn::make('fecha_envio')
                    ->label('Fecha Envío')
                    ->dateTime()
                    ->sortable(),

                IconColumn::make('leido')
                    ->label('Leído')
                    ->boolean()
                    ->trueIcon('heroicon-o-check-circle')
                    ->falseIcon('heroicon-o-clock')
                    ->trueColor('success')
                    ->falseColor('warning'),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('leido')
                    ->label('Estado')
                    ->options([
                        '1' => 'Leído',
                        '0' => 'No Leído',
                    ]),

                SelectFilter::make('id_usuario')
                    ->label('Usuario')
                    ->relationship('usuario', 'name')
                    ->searchable()
                    ->preload(),
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
            ->defaultSort('fecha_envio', 'desc');
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
            'index' => Pages\ListNotificacions::route('/'),
            'create' => Pages\CreateNotificacion::route('/create'),
            'edit' => Pages\EditNotificacion::route('/{record}/edit'),
        ];
    }
}
