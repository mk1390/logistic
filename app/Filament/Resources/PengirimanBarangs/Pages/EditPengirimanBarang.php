<?php

namespace App\Filament\Resources\PengirimanBarangs\Pages;

use App\Filament\Resources\PengirimanBarangs\PengirimanBarangResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditPengirimanBarang extends EditRecord
{
    protected static string $resource = PengirimanBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
