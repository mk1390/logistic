<?php

namespace App\Filament\Resources\PelindungBarangs\Pages;

use App\Filament\Resources\PelindungBarangs\PelindungBarangResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListPelindungBarangs extends ListRecords
{
    protected static string $resource = PelindungBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
