<?php

namespace App\Filament\Resources\ExamResults\Schemas;

use App\Models\ExamBank;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ExamResultForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('student_id')
                    ->label('Student')
                    ->relationship('student', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Select::make('exam_id')
                    ->label('Exam')
                    ->relationship('exam', 'question_text')
                    ->getOptionLabelFromRecordUsing(function (ExamBank $record) {
                        $subject = optional($record->subject)->name ?? '—';
                        return $subject . ' — ' . Str::limit((string) $record->question_text, 60);
                    })
                    ->searchable()
                    ->preload()
                    ->live()
                    ->afterStateUpdated(function (Set $set, $state) {
                        $subjectId = optional(ExamBank::find($state))->subject_id;
                        $set('subject_id', $subjectId);
                    })
                    ->required(),

                Select::make('subject_id')
                    ->label('Subject')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                TextInput::make('score')
                    ->label('Score')
                    ->numeric()
                    ->minValue(0)
                    ->maxValue(100)
                    ->required(),
            ]);
    }
}
