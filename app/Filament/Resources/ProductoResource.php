<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductoResource\Pages;
use App\Filament\Resources\ProductoResource\RelationManagers;
use App\Models\Producto;
use App\Models\Categoria;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\IconColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class ProductoResource extends Resource
{
    protected static ?string $model = Producto::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $navigationLabel = 'Productos';

    protected static ?string $modelLabel = 'Producto';

    protected static ?string $pluralModelLabel = 'Productos';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('nombre')
                    ->label('Nombre')
                    ->required()
                    ->maxLength(255),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(3)
                    ->maxLength(1000),

                TextInput::make('precio')
                    ->label('Precio')
                    ->numeric()
                    ->prefix('Bs.')
                    ->required()
                    ->minValue(0),

                TextInput::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->required()
                    ->minValue(0),

                Select::make('id_categoria')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->required()
                    ->preload()
                    ->createOptionForm([
                        TextInput::make('nombre')
                            ->label('Nombre de la categoría')
                            ->required(),
                    ]),

                Select::make('estado')
                    ->label('Estado')
                    ->options([
                        'disponible' => 'Disponible',
                        'no_disponible' => 'No Disponible',
                    ])
                    ->default('disponible')
                    ->required(),

                FileUpload::make('imagen')
                    ->label('Imagen')
                    ->image()
                    ->imageEditor()
                    ->directory('productos'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('imagen')
                    ->label('Imagen')
                    ->circular()
                    ->defaultImageUrl(url('/images/placeholder.png')),

                TextColumn::make('nombre')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('categoria.nombre')
                    ->label('Categoría')
                    ->badge()
                    ->sortable(),

                TextColumn::make('precio')
                    ->label('Precio (Bs)')
                    ->formatStateUsing(fn ($state) => '<span class="text-xs align-top">Bs</span> ' . number_format($state, 2, '.', ','))
                    ->html()
                    ->sortable(),

                TextColumn::make('stock')
                    ->label('Stock')
                    ->numeric()
                    ->sortable()
                    ->color(fn(string $state): string => match (true) {
                        $state == 0 => 'danger',
                        $state <= 10 => 'warning',
                        default => 'success',
                    }),

                TextColumn::make('estado')
                    ->label('Estado')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'disponible' => 'success',
                        'no_disponible' => 'danger',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn(string $state): string => match ($state) {
                        'disponible' => 'Disponible',
                        'no_disponible' => 'No Disponible',
                        default => $state,
                    }),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('id_categoria')
                    ->label('Categoría')
                    ->relationship('categoria', 'nombre')
                    ->preload(),

                SelectFilter::make('estado')
                    ->label('Estado')
                    ->options([
                        'disponible' => 'Disponible',
                        'no_disponible' => 'No Disponible',
                    ]),
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
            'index' => Pages\ListProductos::route('/'),
            'create' => Pages\CreateProducto::route('/create'),
            'edit' => Pages\EditProducto::route('/{record}/edit'),
        ];
    }
}
