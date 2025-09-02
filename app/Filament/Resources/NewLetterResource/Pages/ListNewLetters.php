<?php

namespace App\Filament\Resources\NewLetterResource\Pages;

use App\Filament\Resources\NewLetterResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListNewLetters extends ListRecords
{
    protected static string $resource = NewLetterResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
