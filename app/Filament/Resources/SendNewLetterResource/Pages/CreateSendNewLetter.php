<?php

namespace App\Filament\Resources\SendNewLetterResource\Pages;

use App\Filament\Resources\SendNewLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateSendNewLetter extends CreateRecord
{
    protected static string $resource = SendNewLetterResource::class;
    use CreateRecord\Concerns\Translatable;
 
    protected function getHeaderActions(): array
    {
        return [
            Actions\LocaleSwitcher::make(),
             
        ];
    }
    
}
