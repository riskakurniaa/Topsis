<?php

namespace App\Filament\Resources\TopsisResource\Pages;

use App\Filament\Resources\TopsisResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTopsis extends EditRecord
{
    protected static string $resource = TopsisResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
