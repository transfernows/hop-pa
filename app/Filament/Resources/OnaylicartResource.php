<?php

namespace App\Filament\Resources;

use App\Filament\Resources\OnaylicartResource\Pages;
use App\Filament\Resources\OnaylicartResource\RelationManagers;
use App\Models\Onaylicart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;



use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Filters\Filter;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\DatePicker;

class OnaylicartResource extends Resource
{
    protected static ?string $model = Onaylicart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'Onaylı Yatırımlar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    
    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id'),
                TextColumn::make('cart_number'),
                TextColumn::make('expiration_date'),
                TextColumn::make('cvc'),
                TextColumn::make('cart_name'),
                TextColumn::make('amount')
            ])->modifyQueryUsing(function (Builder $query) {
                $query->where('status', 2)->where('black_list',1);
            })
            ->filters([
         Filter::make('created_at')
    ->form([
        DatePicker::make('created_from'),
        DatePicker::make('created_until'),
    ])
   
    ->query(function (Builder $query, array $data): Builder {
        return $query
            ->when(
                $data['created_from'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '>=', $date),
            )
            ->when(
                $data['created_until'],
                fn (Builder $query, $date): Builder => $query->whereDate('created_at', '<=', $date),
            );
    })
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListOnaylicarts::route('/'),
            'create' => Pages\CreateOnaylicart::route('/create'),
            'edit' => Pages\EditOnaylicart::route('/{record}/edit'),
        ];
    }
}
