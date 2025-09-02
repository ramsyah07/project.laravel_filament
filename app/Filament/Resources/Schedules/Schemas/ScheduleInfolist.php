<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class ScheduleInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('subject.name')->label('Subject'),
                TextEntry::make('teacher.name')->label('Teacher'),
                TextEntry::make('classroom.name')->label('Classroom'),
                TextEntry::make('day')->label('Day'),
                TextEntry::make('time')->label('Time'),
                TextEntry::make('created_at')->label('Created At')->dateTime(),
            ]);
    }
}
