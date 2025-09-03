<?php

namespace App\Filament\Resources\Agents\Pages;

use App\Filament\Resources\Agents\AgentResource;
use Filament\Resources\Pages\CreateRecord;

class CreateAgent extends CreateRecord
{
    protected static string $resource = AgentResource::class;
    protected function getRedirectUrl(): string
    {
        // Redirect ke halaman List setelah create
        return $this->getResource()::getUrl('index');
    }
}
