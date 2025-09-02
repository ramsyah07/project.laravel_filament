<?php

namespace App\Filament\Resources\Students\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Schemas\Schema;
use App\Models\Classroom;

class StudentForm
{
    public static function configure(Schema $schema): Schema
    {
        $currentYear = date('Y');
        
        return $schema
            ->components([
                TextInput::make('nisn')
                    ->label('NISN')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(20)
                    ->helperText('Nomor Induk Siswa Nasional'),

                TextInput::make('name')
                    ->label('Nama Lengkap')
                    ->required()
                    ->maxLength(255),

                Select::make('classroom_id')
                    ->label('Kelas')
                    ->options(Classroom::all()->pluck('name', 'id'))
                    ->required()
                    ->searchable(),

                Select::make('entry_year_start')
                    ->label('Tahun Masuk')
                    ->options([
                        ($currentYear - 5) => ($currentYear - 5),
                        ($currentYear - 4) => ($currentYear - 4),
                        ($currentYear - 3) => ($currentYear - 3),
                        ($currentYear - 2) => ($currentYear - 2),
                        ($currentYear - 1) => ($currentYear - 1),
                        $currentYear => $currentYear,
                        ($currentYear + 1) => ($currentYear + 1),
                    ])
                    ->default($currentYear)
                    ->required()
                    ->reactive()
                    ->afterStateUpdated(function ($state, $set) {
                        // Auto-set tahun lulus = tahun masuk + 3 tahun (SMA)
                        if ($state) {
                            $set('entry_year_end', $state + 3);
                        }
                    })
                    ->helperText('Pilih tahun masuk, tahun lulus akan otomatis terisi'),

                Select::make('entry_year_end')
                    ->label('Tahun Lulus')
                    ->options([
                        ($currentYear - 2) => ($currentYear - 2), // untuk alumni
                        ($currentYear - 1) => ($currentYear - 1),
                        $currentYear => $currentYear,
                        ($currentYear + 1) => ($currentYear + 1),
                        ($currentYear + 2) => ($currentYear + 2),
                        ($currentYear + 3) => ($currentYear + 3),
                        ($currentYear + 4) => ($currentYear + 4),
                        ($currentYear + 5) => ($currentYear + 5),
                    ])
                    ->required()
                    ->helperText('Otomatis terisi berdasarkan tahun masuk (SMA = 3 tahun)'),

                Select::make('status')
                    ->label('Status')
                    ->options([
                        'active' => 'Aktif',
                        'inactive' => 'Tidak Aktif', 
                        'graduated' => 'Lulus',
                    ])
                    ->default('active')
                    ->required(),
            ]);
    }
}