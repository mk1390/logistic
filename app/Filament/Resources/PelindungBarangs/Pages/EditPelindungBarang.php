<?php

namespace App\Filament\Resources\PelindungBarangs\Pages;

use App\Filament\Resources\PelindungBarangs\PelindungBarangResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditPelindungBarang extends EditRecord
{
    protected static string $resource = PelindungBarangResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
