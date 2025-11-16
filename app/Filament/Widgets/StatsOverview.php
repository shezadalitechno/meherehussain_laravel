<?php

namespace App\Filament\Widgets;

use App\Models\Book;
use App\Models\Collection;
use App\Models\ContactRequest;
use App\Models\Hadith;
use App\Models\Page;
use App\Models\Scholar;
use App\Models\Topic;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Collections', Collection::count())
                ->description('Hadith collections in the system')
                ->descriptionIcon('heroicon-o-bookmark')
                ->color('primary')
                ->chart([7, 3, 4, 5, 6, 3, 5]),

            Stat::make('Total Books', Book::count())
                ->description('Books across all collections')
                ->descriptionIcon('heroicon-o-book-open')
                ->color('success')
                ->chart([3, 2, 1, 4, 5, 3, 4]),

            Stat::make('Total Hadith', Hadith::count())
                ->description('Hadith records available')
                ->descriptionIcon('heroicon-o-document-text')
                ->color('info')
                ->chart([10, 15, 12, 18, 20, 15, 17]),

            Stat::make('Total Scholars', Scholar::count())
                ->description('Scholars in the database')
                ->descriptionIcon('heroicon-o-user-circle')
                ->color('warning')
                ->chart([2, 1, 3, 2, 1, 2, 3]),

            Stat::make('Total Topics', Topic::count())
                ->description('Topics categorized')
                ->descriptionIcon('heroicon-o-tag')
                ->color('danger')
                ->chart([5, 4, 6, 5, 7, 6, 8]),

            Stat::make('Total Pages', Page::count())
                ->description('Content pages created')
                ->descriptionIcon('heroicon-o-document')
                ->color('gray')
                ->chart([1, 2, 1, 3, 2, 1, 2]),

            Stat::make('Contact Requests', ContactRequest::count())
                ->description('Pending contact inquiries')
                ->descriptionIcon('heroicon-o-envelope')
                ->color('primary')
                ->chart([2, 3, 1, 4, 2, 3, 2]),
        ];
    }
}

