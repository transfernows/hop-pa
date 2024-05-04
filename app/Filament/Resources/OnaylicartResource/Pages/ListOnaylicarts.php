<?php

namespace App\Filament\Resources\OnaylicartResource\Pages;

use App\Filament\Resources\OnaylicartResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListOnaylicarts extends ListRecords
{
    protected static string $resource = OnaylicartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
