<?php

namespace App\Filament\Resources\KotaKabupatens\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Symfony\Contracts\Service\Attribute\Required;

class KotaKabupatenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_kota')
                ->label('Nama Kota/Kabupaten (exp: SURABAYA)')
                ->required(),
                TextInput::make('inisial_kota')
                ->label('Inisial Kota/Kabupaten (exp: SBY)')
                ->maxLength('3')
                ->required(),
            ]);
    }
}
