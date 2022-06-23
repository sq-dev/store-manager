<?php

namespace App\Filament\Widgets;

use App\Models\Client;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\Widget;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverviewWidget extends BaseWidget
{
    protected static ?int $sort = 0;

    protected function getCards(): array
    {
        $clients = new Client();
        return [
            Card::make('Новых клентов', $clients->where('created_at', '>=', now()->subDays(7))->count())
                ->chartColor($clients->isBetterThenTomorrow() ? 'success' : 'danger')
                ->chart($clients->countCreated(7))
                ->description('Число новых клиентов за последние 7 дней')
                ->descriptionIcon('heroicon-s-user-group'),

            Card::make('New orders', '3543')
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([15, 4, 10, 2, 12, 4, 12])
                ->color('success'),

            Card::make('Revenue', '$192.1k')
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
