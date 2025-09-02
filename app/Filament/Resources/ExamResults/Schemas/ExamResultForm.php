<?php

namespace App\Filament\Resources\ExamResults\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ExamResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->relationship('student', 'name')
                    ->required(),
                Select::make('exam_id')
                    ->relationship('exam', 'id')
                    ->required(),
                TextInput::make('score')
                    ->required()
                    ->numeric(),
            ]);
    }
}
