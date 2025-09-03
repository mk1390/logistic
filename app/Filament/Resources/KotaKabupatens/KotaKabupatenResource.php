<?php

namespace App\Filament\Resources\KotaKabupatens;

use App\Filament\Resources\KotaKabupatens\Pages\CreateKotaKabupaten;
use App\Filament\Resources\KotaKabupatens\Pages\EditKotaKabupaten;
use App\Filament\Resources\KotaKabupatens\Pages\ListKotaKabupatens;
use App\Filament\Resources\KotaKabupatens\Schemas\KotaKabupatenForm;
use App\Filament\Resources\KotaKabupatens\Tables\KotaKabupatensTable;
use App\Models\KotaKabupaten;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class KotaKabupatenResource extends Resource
{
    protected static ?string $model = KotaKabupaten::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedMap;

    protected static string | UnitEnum | null $navigationGroup = 'Settings';

    protected static ?int $navigationSort = 1 ; 

    protected static ?string $navigationLabel = 'Kota/Kabupaten';

    public static function form(Schema $schema): Schema
    {
        return KotaKabupatenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return KotaKabupatensTable::configure($table);
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
            'index' => ListKotaKabupatens::route('/'),
            'create' => CreateKotaKabupaten::route('/create'),
            'edit' => EditKotaKabupaten::route('/{record}/edit'),
        ];
    }
}
