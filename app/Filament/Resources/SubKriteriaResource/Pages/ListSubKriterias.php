<?php

// app/Filament/Resources/SubKriteriaResource/Pages/ListSubKriterias.php
namespace App\Filament\Resources\SubKriteriaResource\Pages;

use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\KriteriaResource;
use App\Filament\Resources\SubKriteriaResource;

class ListSubKriterias extends ListRecords
{
    protected static string $resource = SubKriteriaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
