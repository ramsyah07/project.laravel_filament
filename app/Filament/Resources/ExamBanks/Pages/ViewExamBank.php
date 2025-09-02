<?php

namespace App\Filament\Resources\ExamBanks\Pages;

use App\Filament\Resources\ExamBanks\ExamBankResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewExamBank extends ViewRecord
{
    protected static string $resource = ExamBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
