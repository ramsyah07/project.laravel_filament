<?php

namespace App\Filament\Resources\ExamBanks\Pages;

use App\Filament\Resources\ExamBanks\ExamBankResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditExamBank extends EditRecord
{
    protected static string $resource = ExamBankResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
