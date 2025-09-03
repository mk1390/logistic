<?php

namespace App\Filament\Resources\PelindungBarangs\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class PelindungBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('pelindung_barang')
                ->required()
                ->label('Pelindung Barang'),
                TextInput::make('keterangan')
                ->nullable(),
            ]);
    }
}
