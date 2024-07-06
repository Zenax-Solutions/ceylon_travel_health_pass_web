<?php

namespace App\Filament\Resources\DestinationResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Filters\DateRangeFilter;
use App\Models\DestinationTicketStockHistory;

class DestinationStockRelationManager extends RelationManager
{
    protected static string $relationship = 'destinationStock';

    protected static ?string $title = 'Ticket Stock Count';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('ticket_stock_count')
                    ->required()
                    ->numeric(),
                Forms\Components\DatePicker::make('date')
                    ->default(now())
                    ->readOnly()
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('destination_id')
            ->columns([
                Tables\Columns\TextColumn::make('ticket_stock_count')
                    ->badge()
                    ->color('success'),
                Tables\Columns\TextColumn::make('selling_ticket_count')
                    ->description(fn (DestinationTicketStockHistory $record): string => 'remaining : ' . $record->ticket_stock_count - $record->selling_ticket_count)
                    ->badge()
                    ->color('warning'),
                Tables\Columns\TextColumn::make('over_selling')
                    ->badge()
                    ->color('danger'),
                Tables\Columns\TextColumn::make('date'),

            ])
            ->filters([
                DateRangeFilter::make('date'),
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make()->label('Add New Stock'),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}
