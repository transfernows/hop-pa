<?php

namespace App\Filament\Resources;

use App\Filament\Resources\CartResource\Pages;
use App\Filament\Resources\CartResource\RelationManagers;
use App\Models\Cart;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;

use Filament\Tables\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\Components\Tab;
use Filament\Forms\Components\DatePicker;


class CartResource extends Resource
{
    protected static ?string $model = Cart::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    
    protected static ?string $navigationLabel = 'Bekleyen Yatırımlar';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('cart_name'),
                  TextInput::make('cart_number'),
                  TextInput::make('expiration_date'),
                  TextInput::make('cvc'),
        
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
                $query->where('status', 0)->where('black_list', 0);
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
            'index' => Pages\ListCarts::route('/'),
            'create' => Pages\CreateCart::route('/create'),
            'edit' => Pages\EditCart::route('/{record}/edit'),
        ];
    }
}
