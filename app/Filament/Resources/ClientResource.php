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

    protected static ?string $navigationLabel = 'Клиенты';

    protected static ?string $breadcrumb = 'Клиенты';

    protected static ?string $navigationGroup = 'Управление';
    
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make([
                    TextInput::make('name')
                        ->label('ФИО клиента')
                        ->required(),
                    TextInput::make('phone')
                        ->label('Номер телефона')
                        ->prefix('+992')
                        ->mask(
                            fn (TextInput\Mask $mask) => $mask
                                ->numeric()
                                ->minValue(9)
                                ->pattern('(000) 00-00-00')
                        )
                        ->unique(ignoreRecord:true)
                        ->required(),

                    TextInput::make('address')
                        ->label('Адрес')
                        ->required(),
                    TextInput::make('email')
                        ->label('Эл. почта')
                        ->email()
                        ->unique(ignoreRecord:true),
                    Textarea::make('comment')
                        ->label('Коментария')
                        ->columnSpan(2)
                ])->columns(['sm' => 2])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('ФИО клиента'),

                TextColumn::make('phone')
                    ->label('Номер телефона')
                    ->prefix('+992 '),

                TextColumn::make('address')
                    ->label('Адрес'),

                TextColumn::make('email')
                    ->default('Не имеется')
                    ->label('Эл. почта'),
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
