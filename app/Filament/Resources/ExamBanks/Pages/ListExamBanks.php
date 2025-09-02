<?php

namespace App\Filament\Resources\ExamBanks\Pages;

use App\Filament\Resources\ExamBanks\ExamBankResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListExamBanks extends ListRecords
{
    protected static string $resource = ExamBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
