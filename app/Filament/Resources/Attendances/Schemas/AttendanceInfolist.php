<?php

namespace App\Filament\Resources\Attendances\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Infolists\Components\TextEntry;


class AttendanceInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Student Information')
                    ->icon('heroicon-o-academic-cap')
                    ->schema([
                        TextEntry::make('student.name')
                            ->label('Student Name'),
                        TextEntry::make('student.student_id')
                            ->label('Student ID'),
                        TextEntry::make('student.email')
                            ->label('Student Email')
                            ->default('N/A'),
                    ])->columns(2),
                
                Section::make('Schedule Information')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        TextEntry::make('schedule.subject.name')
                            ->label('Subject'),
                        TextEntry::make('schedule.teacher.name')
                            ->label('Teacher'),
                        TextEntry::make('schedule.classroom.name')
                            ->label('Classroom'),
                        TextEntry::make('date')
                            ->label('Attendance Date')
                            ->date(),
                    ])->columns(2),
                
                Section::make('Attendance Status')
                    ->icon('heroicon-o-check-circle')
                    ->schema([
                        TextEntry::make('status')
                            ->label('Status')
                            ->colors([
                                'success' => 'present',
                                'danger' => 'absent',
                                'warning' => 'late',
                            ]),
                        TextEntry::make('verified_by_user.name')
                            ->label('Verified By')
                            ->default('Not verified')
                            ->badge()
                            ->color('gray'),
                    ])->columns(2),
                
                Section::make('System Information')
                    ->icon('heroicon-o-information-circle')
                    ->collapsed() // Collapsed by default
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Created At')
                            ->dateTime(),
                        TextEntry::make('updated_at')
                            ->label('Updated At')
                            ->dateTime(),
                    ])->columns(2),
            ]);
    }
}