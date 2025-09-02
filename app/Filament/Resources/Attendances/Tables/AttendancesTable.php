<?php

namespace App\Filament\Resources\Attendances\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Table;
use Filament\Tables\Filters\SelectFilter;

class AttendancesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student.name')
                    ->label('Student Name')
                    ->searchable(),
                TextColumn::make('schedule.subject.name')
                    ->label('Subject')
                    ->searchable(),
                TextColumn::make('schedule.teacher.name')
                    ->label('Teacher')
                    ->searchable(),
                TextColumn::make('schedule.classroom.name')
                    ->label('Classroom')
                    ->searchable(),
                TextColumn::make('date')
                    ->date()
                    ->searchable()
                    ->sortable(),
                TextColumn::make('status')
                    ->colors([
                        'success' => 'present',
                        'danger' => 'absent',
                        'warning' => 'late',
                    ])
                    ->sortable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'present' => 'Present',
                        'absent' => 'Absent',
                        'late' => 'Late',
                    ]),
                SelectFilter::make('schedule.subject.name')
                    ->label('Subject')
                    ->relationship('schedule.subject', 'name'),
                SelectFilter::make('schedule.teacher.name')
                    ->label('Teacher')
                    ->relationship('schedule.teacher', 'name'),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
