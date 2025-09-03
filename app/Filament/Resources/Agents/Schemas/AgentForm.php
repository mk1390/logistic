<?php

namespace App\Filament\Resources\Agents\Schemas;

use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use PhpParser\Node\Stmt\Label;

class AgentForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('nama_agent')
                ->Label('Nama Agent')
                ->required(),
                
                TextInput::make('no_telepon')
                ->Label('Telepon Agent')
                ->required()
                ->tel()
                ->suffixIcon(Heroicon::Phone),
                
                Textarea::make('alamat')
                ->Label('Alamat Agent'),
                


            ]);
    }
}
