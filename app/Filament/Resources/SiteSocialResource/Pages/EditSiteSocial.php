<?php

namespace App\Filament\Resources\SiteSocialResource\Pages;

use App\Filament\Resources\SiteSocialResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSiteSocial extends EditRecord
{
    protected static string $resource = SiteSocialResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
