<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ShopeQrScanRecordResource\Pages;
use App\Filament\Resources\ShopeQrScanRecordResource\RelationManagers;
use App\Models\ShopeQrScanRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Filters\SelectFilter;

class ShopeQrScanRecordResource extends Resource
{
    protected static ?string $model = ShopeQrScanRecord::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('shop_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('ticket_id')
                    ->required()
                    ->maxLength(255),
                Forms\Components\TextInput::make('status')
                    ->required()
                    ->maxLength(255)
                    ->default('used'),
                Forms\Components\DatePicker::make('date')
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('discountShop.shope_name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('ticket_id')
                    ->searchable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'used' => 'danger',
                    }),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('shop_id')
                    ->relationship('discountShop', 'shope_name')
                    ->indicator('Shop')
                    ->label('Shop List'),
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListShopeQrScanRecords::route('/'),
            //'create' => Pages\CreateShopeQrScanRecord::route('/create'),
            // 'edit' => Pages\EditShopeQrScanRecord::route('/{record}/edit'),
        ];
    }
}
