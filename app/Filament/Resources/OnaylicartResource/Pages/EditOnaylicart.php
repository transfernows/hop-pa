<?php

namespace App\Filament\Resources\OnaylicartResource\Pages;

use App\Filament\Resources\OnaylicartResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditOnaylicart extends EditRecord
{
    protected static string $resource = OnaylicartResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
