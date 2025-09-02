<?php

namespace App\Filament\Resources\SendNewLetterResource\Pages;

use App\Filament\Resources\SendNewLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSendNewLetter extends EditRecord
{
    protected static string $resource = SendNewLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
