<?php

namespace App\Filament\Resources\JenisBarangs\Pages;

use App\Filament\Resources\JenisBarangs\JenisBarangResource;
use Filament\Resources\Pages\CreateRecord;

class CreateJenisBarang extends CreateRecord

{
    protected static string $resource = JenisBarangResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman List setelah create
        return $this->getResource()::getUrl('index');
    }
}
