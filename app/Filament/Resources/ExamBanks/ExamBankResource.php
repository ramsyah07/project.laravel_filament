<?php

namespace App\Filament\Resources\ExamBanks;

use App\Enums\NavigationGroup;
use App\Enums\NavigationIcon;
use App\Filament\Resources\ExamBanks\Pages\CreateExamBank;
use App\Filament\Resources\ExamBanks\Pages\EditExamBank;
use App\Filament\Resources\ExamBanks\Pages\ListExamBanks;
use App\Filament\Resources\ExamBanks\Pages\ViewExamBank;
use App\Filament\Resources\ExamBanks\Schemas\ExamBankForm;
use App\Filament\Resources\ExamBanks\Schemas\ExamBankInfolist;
use App\Filament\Resources\ExamBanks\Tables\ExamBanksTable;
use App\Models\ExamBank;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;

class ExamBankResource extends Resource
{
    protected static ?string $model = ExamBank::class;

    protected static \BackedEnum|string|null $navigationIcon = NavigationIcon::EXAM_BANK->value;
    protected static \UnitEnum|string|null   $navigationGroup = NavigationGroup::Assesment;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return ExamBankForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return ExamBankInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ExamBanksTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListExamBanks::route('/'),
            'create' => CreateExamBank::route('/create'),
            'view' => ViewExamBank::route('/{record}'),
            'edit' => EditExamBank::route('/{record}/edit'),
        ];
    }
}
