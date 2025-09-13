<?php

namespace App\Filament\Resources\Trackings\Pages;

use App\Filament\Resources\Trackings\TrackingResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewTracking extends ViewRecord
{
    protected static string $resource = TrackingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
