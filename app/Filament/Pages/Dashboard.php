<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;
use BackedEnum;
use UnitEnum;

class Dashboard extends BaseDashboard
{
    protected static BackedEnum|string|null $navigationIcon = 'heroicon-o-home';

    protected static UnitEnum|string|null $navigationGroup = null;

    protected static ?int $navigationSort = -2;
}

