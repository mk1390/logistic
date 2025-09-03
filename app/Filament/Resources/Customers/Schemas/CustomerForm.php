<?php

namespace App\Filament\Resources\Customers\Schemas;

use Dom\Text;
use Filament\Schemas\Schema;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;

class CustomerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_perusahaan')
                ->label('Nama Perusahaan')
                ->required(),
                
                TextInput::make('perusahaan_telp')
                ->label('Telepon Prusahaan')
                ->tel(),
                
                Textarea::make('alamat_perusahaan')
                ->label('Alamat Perusahaan')
                ->rows(3),
            ]);
    }
}
