<?php

namespace App\Filament\Resources\JenisBarangs\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

use function Laravel\Prompts\textarea;

class JenisBarangForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('jenis_barang')
                ->label('Jenis Barang (exp: Alat Komunikasi, Alat Kedokteran dll)')
                ->required(),
                TextInput::make('keterangan')
                ->label('Keterangan')
                ->required(),
            ]);
    }
}
