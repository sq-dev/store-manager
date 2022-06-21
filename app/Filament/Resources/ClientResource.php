<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ClientResource\Pages;
use App\Models\Client;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;

class ClientResource extends Resource
{
    protected static ?string $model = Client::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label('Ном')
                        ->required(),
                    TextInput::make('phone')
                        ->label('Номери телефон')
                        ->prefix('+992')
                        ->mask(
                            fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->minValue(9)
                                ->pattern('(000) 00-00-00')
                        )
                        ->unique()
                        ->required(),
                    TextInput::make('address')
                        ->label('Адреса')
                        ->required(),
                    TextInput::make('email')
                        ->label('Почтаи электрони')
                        ->email(),
                    Textarea::make('comment')
                        ->label('Кайд')
                        ->columnSpan(2)
                ])->columns(['sm' => 2])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Ном'),
                TextColumn::make('phone')
                    ->label('Номери телефон')
                    ->prefix('+992 '),
                TextColumn::make('address')
                    ->label('Адрес'),
                TextColumn::make('email')
                    ->default('Надорад')
                    ->label('Почтаи электрони'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListClients::route('/'),
            'create' => Pages\CreateClient::route('/create'),
            'edit' => Pages\EditClient::route('/{record}/edit'),
        ];
    }
}
