<?php

namespace App\Filament\Resources\NewLetterResource\Pages;

use App\Filament\Resources\NewLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditNewLetter extends EditRecord
{
    protected static string $resource = NewLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
