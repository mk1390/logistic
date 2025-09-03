<?php

namespace App\Filament\Resources\JenisBarangs;

use App\Filament\Resources\JenisBarangs\Pages\CreateJenisBarang;
use App\Filament\Resources\JenisBarangs\Pages\EditJenisBarang;
use App\Filament\Resources\JenisBarangs\Pages\ListJenisBarangs;
use App\Filament\Resources\JenisBarangs\Schemas\JenisBarangForm;
use App\Filament\Resources\JenisBarangs\Tables\JenisBarangsTable;
use App\Models\JenisBarang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class JenisBarangResource extends Resource
{
    protected static ?string $model = JenisBarang::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedInbox;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return JenisBarangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return JenisBarangsTable::configure($table);
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
            'index' => ListJenisBarangs::route('/'),
            'create' => CreateJenisBarang::route('/create'),
            'edit' => EditJenisBarang::route('/{record}/edit'),
        ];
    }
}
