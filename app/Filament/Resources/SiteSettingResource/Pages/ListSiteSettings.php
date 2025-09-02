<?php

namespace App\Filament\Resources\SiteSettingResource\Pages;

use App\Filament\Resources\SiteSettingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSiteSettings extends ListRecords
{
    protected static string $resource = SiteSettingResource::class;
    use ListRecords\Concerns\Translatable;
    protected function getHeaderActions(): array
    {
        return [
          
           Actions\LocaleSwitcher::make(),

        ];
    }
}
