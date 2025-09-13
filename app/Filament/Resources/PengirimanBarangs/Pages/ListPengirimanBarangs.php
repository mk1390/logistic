<?php

namespace App\Filament\Resources\PengirimanBarangs\Pages;

use App\Filament\Resources\PengirimanBarangs\PengirimanBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPengirimanBarangs extends ListRecords
{
    protected static string $resource = PengirimanBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
