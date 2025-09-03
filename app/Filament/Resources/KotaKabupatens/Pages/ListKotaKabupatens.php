<?php

namespace App\Filament\Resources\KotaKabupatens\Pages;

use App\Filament\Resources\KotaKabupatens\KotaKabupatenResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListKotaKabupatens extends ListRecords
{
    protected static string $resource = KotaKabupatenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
