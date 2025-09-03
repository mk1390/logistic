<?php

namespace App\Filament\Resources\PelindungBarangs\Pages;

use App\Filament\Resources\PelindungBarangs\PelindungBarangResource;
use Filament\Resources\Pages\CreateRecord;

class CreatePelindungBarang extends CreateRecord
{
    protected static string $resource = PelindungBarangResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman List setelah create
        return $this->getResource()::getUrl('index');
    }
}
