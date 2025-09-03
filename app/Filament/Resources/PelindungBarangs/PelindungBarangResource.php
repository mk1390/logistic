<?php

namespace App\Filament\Resources\PelindungBarangs;

use App\Filament\Resources\PelindungBarangs\Pages\CreatePelindungBarang;
use App\Filament\Resources\PelindungBarangs\Pages\EditPelindungBarang;
use App\Filament\Resources\PelindungBarangs\Pages\ListPelindungBarangs;
use App\Filament\Resources\PelindungBarangs\Schemas\PelindungBarangForm;
use App\Filament\Resources\PelindungBarangs\Tables\PelindungBarangsTable;
use App\Models\PelindungBarang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Ramsey\Uuid\Type\Integer;
use UnitEnum;

class PelindungBarangResource extends Resource
{
    protected static ?string $model = PelindungBarang::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedShieldCheck;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    public static function form(Schema $schema): Schema
    {
        return PelindungBarangForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PelindungBarangsTable::configure($table);
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
            'index' => ListPelindungBarangs::route('/'),
            'create' => CreatePelindungBarang::route('/create'),
            'edit' => EditPelindungBarang::route('/{record}/edit'),
        ];
    }
}
