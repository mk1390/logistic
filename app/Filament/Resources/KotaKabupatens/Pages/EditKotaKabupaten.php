<?php

namespace App\Filament\Resources\KotaKabupatens\Pages;

use App\Filament\Resources\KotaKabupatens\KotaKabupatenResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditKotaKabupaten extends EditRecord
{
    protected static string $resource = KotaKabupatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
