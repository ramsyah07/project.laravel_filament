<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    protected static ?string $title = 'School Management Dashboard';
    
    protected static ?string $navigationLabel = 'Dashboard';
    
    public function getWidgets(): array
    {
        return [
            \App\Filament\Widgets\ScheduleCalendar::class,
            \App\filament\Widgets\StudentChart::class,
        ];
    }
    
    public function getColumns(): int | array
    {
        return [
            'sm' => 1,
            'md' => 2,
            'lg' => 3,
        ];
    }

    // Override to prevent default widgets from showing
    protected function getHeaderWidgets(): array
    {
        return [];
    }

    // Override to prevent default widgets from showing  
    protected function getFooterWidgets(): array
    {
        return [];
    }

    // Override default dashboard stats
    public function getVisibleHeaderWidgets(): array
    {
        return [];
    }

    // Override default dashboard stats
    public function getVisibleFooterWidgets(): array
    {
        return [];
    }
}

