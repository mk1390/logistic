<?php

namespace App\Filament\Resources\Trackings;

use App\Filament\Resources\Trackings\Pages\CreateTracking;
use App\Filament\Resources\Trackings\Pages\EditTracking;
use App\Filament\Resources\Trackings\Pages\ListTrackings;
use App\Filament\Resources\Trackings\Pages\ViewTracking;
use App\Filament\Resources\Trackings\Schemas\TrackingForm;
use App\Filament\Resources\Trackings\Schemas\TrackingInfolist;
use App\Filament\Resources\Trackings\Tables\TrackingsTable;
use App\Models\Tracking;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class TrackingResource extends Resource
{
    protected static ?string $model = Tracking::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return TrackingForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return TrackingInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return TrackingsTable::configure($table);
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
            'index' => ListTrackings::route('/'),
            'create' => CreateTracking::route('/create'),
            'view' => ViewTracking::route('/{record}'),
            'edit' => EditTracking::route('/{record}/edit'),
        ];
    }
}
