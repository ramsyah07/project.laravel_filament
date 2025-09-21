<?php

namespace App\Filament\Resources\ExamBanks\Schemas;

use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;

class ExamBankForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('subject_id')
                    ->label('Subject')
                    ->relationship('subject', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),

                Textarea::make('question_text')
                    ->label('Question Text')
                    ->rows(4)
                    ->required()
                    ->columnSpanFull(),

                Select::make('teacher_id')
                    ->relationship('teacher','name')
                    ->searchable()
                    ->preload()
                    ->required(),

                KeyValue::make('options')
                    ->label('Choices (key => label)')
                    ->keyLabel('Key (e.g. A, B, C)')
                    ->valueLabel('Label (choice text)')
                    ->addButtonLabel('Add choice')
                    ->reorderable()
                    ->required()
                    ->live()
                    ->columnSpanFull(),

                Select::make('answer')
                    ->label('Correct Answer Key')
                    ->options(function (Get $get) {
                        $opts = $get('options') ?? [];
                        if (! is_array($opts)) {
                            return [];
                        }
                        return collect($opts)
                            ->keys()
                            ->mapWithKeys(fn ($k) => [$k => (string) $k])
                            ->all();
                    })
                    ->helperText('Pilih key yang menjadi jawaban benar, misal: A/B/C')
                    ->searchable()
                    ->required(),
            ]);
    }
}
