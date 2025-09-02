<?php

namespace App\Filament\Resources\Schedules\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;

class SchedulesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // Kolom untuk nomor urut
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),

                // Menampilkan nama subjek dari relasi
                TextColumn::make('subject.name')
                    ->label('Subject')
                    ->searchable()
                    ->sortable(),

                // Menampilkan nama guru dari relasi
                TextColumn::make('teacher.name')
                    ->label('Teacher')
                    ->searchable()
                    ->sortable(),

                // Menampilkan nama kelas dari relasi
                TextColumn::make('classroom.name')
                    ->label('Classroom')
                    ->searchable()
                    ->sortable(),


                // Kolom untuk hari
                TextColumn::make('day')
                    ->label('Day')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk waktu
                TextColumn::make('time')
                    ->label('Time')
                    ->searchable()
                    ->sortable(),

                // Kolom untuk waktu pembuatan (created_at)
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                // Anda bisa menambahkan filter di sini
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->headerActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
