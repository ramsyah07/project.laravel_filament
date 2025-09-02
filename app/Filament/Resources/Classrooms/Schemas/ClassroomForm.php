<?php

namespace App\Filament\Resources\Classrooms\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ClassroomForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('code')
                    ->required(),
                TextInput::make('grade_level')
                    ->required(),
                TextInput::make('major')
                    ->default(null),
                TextInput::make('room_number')
                    ->default(null),
                TextInput::make('building')
                    ->default(null),
                TextInput::make('floor')
                    ->default(null),
            ]);
    }
}
