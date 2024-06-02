<?php

namespace App\Filament\Resources\TopsisResource\Pages;

use App\Filament\Resources\TopsisResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListTopses extends ListRecords
{
    protected static string $resource = TopsisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
