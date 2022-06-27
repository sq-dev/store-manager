<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SupplierResource\Pages;
use App\Models\Supplier;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;

class SupplierResource extends Resource
{
    protected static ?string $model = Supplier::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationLabel = 'Поставщики';

    protected static ?string $breadcrumb = 'Поставщики';

    protected static ?string $navigationGroup = 'Управление';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Card::make([
                TextInput::make('name')
                    ->label('Наименование поставщика')
                    ->columnSpan(2)
                    ->required(),
                TextInput::make('phone')
                    ->label('Номер телефона')
                    ->mask(
                        fn (TextInput\Mask $mask) => $mask
                            ->numeric()
                    )
                    ->unique(ignoreRecord: true)
                    ->required(),
                TextInput::make('email')
                    ->label('Эл. почта')
                    ->email()
                    ->unique(ignoreRecord: true),
                TextInput::make('country')
                    ->label('Страна')
                    ->default('Таджикистан'),
                Toggle::make('is_active')
                    ->label('Активен')
                    ->inline()
                    ->default(true),
                FileUpload::make('photo')
                    ->label('Фото')
                    ->directory('img/suppliers')
                    ->columnSpan(2)
                    ->image()
                    ->maxSize(2048)

            ])->columns(['sm' => 2])
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('photo')
                    ->label('Фото')
                    ->rounded(),
                TextColumn::make('name')
                    ->label('Наименование поставщика'),
                TextColumn::make('phone')
                    ->label('Номер телефона'),
                TextColumn::make('country')
                    ->label('Страна'),
            ])
            ->filters([
                //
            ]);
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
            'index' => Pages\ListSuppliers::route('/'),
            'create' => Pages\CreateSupplier::route('/create'),
            'edit' => Pages\EditSupplier::route('/{record}/edit'),
        ];
    }
}
