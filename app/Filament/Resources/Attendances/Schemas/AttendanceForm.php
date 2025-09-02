<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Schemas\Components\Section;
use App\Models\User;
use App\Models\Student;

class AttendanceForm
{
    public static function configure(Schema $form): Schema
    {
        return $form->schema([
            Section::make('Student Information')
                ->description('Select student for attendance')
                ->icon('heroicon-o-academic-cap')
                ->schema([
                    Select::make('student_id')
                        ->label('Student')
                        ->options(fn() => Student::query()
                            ->orderBy('name')
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Select a student'),
                ]),

            Section::make('Schedule & Attendance Details')
                ->description('Select schedule and mark attendance')
                ->icon('heroicon-o-calendar-days')
                ->schema([
                    Select::make('schedule_id')
                        ->label('Schedule')
                        ->relationship('schedule', 'id')
                        ->getOptionLabelFromRecordUsing(fn($record) => sprintf(
                            '%s - %s (%s)',
                            $record->subject->name ?? 'No Subject',
                            $record->teacher->name ?? 'No Teacher',
                            $record->classroom->name ?? 'No Classroom'
                        ))

                        ->searchable()
                        ->preload()
                        ->required()
                        ->placeholder('Select a schedule'),

                    DatePicker::make('date')
                        ->label('Attendance Date')
                        ->default(now())
                        ->required(),

                    Select::make('status')
                        ->label('Attendance Status')
                        ->options([
                            'present' => 'Present',
                            'absent' => 'Absent',
                            'late' => 'Late',
                        ])
                        ->default('present')
                        ->required()
                        ->placeholder('Select attendance status'),
                ]),

            Section::make('Teacher Assignment')
                ->description('Assign teacher for verification (optional)')
                ->icon('heroicon-o-user-group')
                ->collapsed()
                ->schema([
                    Select::make('verified_by')
                        ->label('Verified by Teacher')
                        ->options(fn() => User::query()
                            ->where('role', 'teacher')
                            ->orWhere('email', 'like', '%teacher%')
                            ->orderBy('name')
                            ->pluck('name', 'id'))
                        ->searchable()
                        ->preload()
                        ->placeholder('Select verifying teacher (optional)')
                        ->helperText('Optional: Select teacher who verified this attendance'),
                ]),
        ]);
    }
}
