<?php

namespace App\Filament\Resources\ClientResource\Pages;

use App\Filament\Resources\ClientResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected static ?string $title = 'Клиенты';

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Новый клиент'),
        ];
    }
}
