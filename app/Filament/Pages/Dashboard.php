<?php

namespace App\Filament\Pages;

use Filament\Pages\Dashboard as BaseDashboard;

class Dashboard extends BaseDashboard
{
    public function getWidgets(): array
    {
        return [
            // Bagian atas (contoh: Calendar)
            \App\Filament\Widgets\ScheduleCalendar::class,

            // Chart Students akan otomatis tampil di bawah
            \App\Filament\Widgets\StudentChart::class,
        ];
    }
}

