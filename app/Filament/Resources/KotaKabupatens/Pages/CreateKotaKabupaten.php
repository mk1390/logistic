<?php

namespace App\Filament\Resources\KotaKabupatens\Pages;

use App\Filament\Resources\KotaKabupatens\KotaKabupatenResource;
use Filament\Resources\Pages\CreateRecord;

class CreateKotaKabupaten extends CreateRecord
{
    protected static string $resource = KotaKabupatenResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman List setelah create
        return $this->getResource()::getUrl('index');
    }
}
