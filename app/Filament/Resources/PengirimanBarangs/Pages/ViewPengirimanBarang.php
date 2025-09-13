<?php

namespace App\Filament\Resources\PengirimanBarangs\Pages;

use App\Filament\Resources\PengirimanBarangs\PengirimanBarangResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewPengirimanBarang extends ViewRecord
{
    protected static string $resource = PengirimanBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
