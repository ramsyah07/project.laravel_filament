<?php

namespace App\Filament\Resources\Schedules\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use App\Models\Subject;
use App\Models\Teacher;

class ScheduleForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subject_id')
                    ->options(Subject::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('teacher_id')
                    ->options(Teacher::all()->pluck('name', 'id'))
                    ->searchable()
                    ->required(),

                Select::make('classroom_id')
                    ->label('Classroom')
                    ->relationship('classroom', 'name') 
                    ->required(),

                Select::make('day')
                    ->label('Day')
                    ->options([
                        'Monday' => 'Monday',
                        'Tuesday' => 'Tuesday',
                        'Wednesday' => 'Wednesday',
                        'Thursday' => 'Thursday',
                        'Friday' => 'Friday',
                        'Saturday' => 'Saturday',
                    ])
                    ->required(),

                TextInput::make('time')
                    ->label('Time')
                    ->required(),
            ]);
    }
}
