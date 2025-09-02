<?php

namespace App\Filament\Resources\Teachers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Select; // Tambahkan ini
use Filament\Schemas\Schema;
use App\Models\Subject; // Import model Subject

class TeacherForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nip')
                    ->required()
                    ->unique(ignoreRecord: true)
                    ->maxLength(15),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('email')
                    ->label('Email address')
                    ->email()
                    ->required()
                    ->unique('teachers', 'email')
                    ->maxLength(255),
                TextInput::make('contact')
                    ->label('Contact Number')
                    ->tel()
                    ->maxLength(15),
                Textarea::make('address')
                    ->columnSpanFull()
                    ->maxLength(200),
                Select::make('subjects')
                    ->label('Subjects')
                    ->multiple() // Bisa pilih lebih dari satu
                    ->options(function () {
                        return Subject::all()->pluck('name', 'id')->toArray();
                    })
                    ->columnSpanFull(),
            ]);
    }
}
