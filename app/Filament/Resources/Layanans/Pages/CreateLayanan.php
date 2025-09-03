<?php

namespace App\Filament\Resources\Layanans\Pages;

use App\Filament\Resources\Layanans\LayananResource;
use Filament\Resources\Pages\CreateRecord;

class CreateLayanan extends CreateRecord
{
    protected static string $resource = LayananResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman List setelah create
        return $this->getResource()::getUrl('index');
    }
}
