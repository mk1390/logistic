<?php

namespace App\Filament\Resources\PengirimanBarangs;

use App\Filament\Resources\PengirimanBarangs\Pages\CreatePengirimanBarang;
use App\Filament\Resources\PengirimanBarangs\Pages\EditPengirimanBarang;
use App\Filament\Resources\PengirimanBarangs\Pages\ListPengirimanBarangs;
use App\Filament\Resources\PengirimanBarangs\Pages\ViewPengirimanBarang;
use App\Filament\Resources\PengirimanBarangs\Schemas\PengirimanBarangForm;
use App\Filament\Resources\PengirimanBarangs\Schemas\PengirimanBarangInfolist;
use App\Filament\Resources\PengirimanBarangs\Tables\PengirimanBarangsTable;
use App\Models\PengirimanBarang;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class PengirimanBarangResource extends Resource
{
    protected static ?string $model = PengirimanBarang::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return PengirimanBarangForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return PengirimanBarangInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return PengirimanBarangsTable::configure($table);
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
            'index' => ListPengirimanBarangs::route('/'),
            'create' => CreatePengirimanBarang::route('/create'),
            'view' => ViewPengirimanBarang::route('/{record}'),
            'edit' => EditPengirimanBarang::route('/{record}/edit'),
        ];
    }
}
