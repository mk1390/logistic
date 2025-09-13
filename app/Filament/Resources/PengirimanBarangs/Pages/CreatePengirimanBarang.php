<?php

namespace App\Filament\Resources\PengirimanBarangs\Pages;

use App\Filament\Resources\PengirimanBarangs\PengirimanBarangResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePengirimanBarang extends CreateRecord
{
    protected static string $resource = PengirimanBarangResource::class;
     protected function getRedirectUrl(): string
    {
        // Redirect ke halaman List setelah create
        return $this->getResource()::getUrl('index');
    }
}
