<?php

namespace App\Filament\Resources\Trackings\Pages;

use App\Filament\Resources\Trackings\TrackingResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListTrackings extends ListRecords
{
    protected static string $resource = TrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
