<?php

namespace App\Filament\Resources\BookingResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\RelationManagers\RelationManager;

class TicketsRelationManager extends RelationManager
{
    protected static string $relationship = 'tickets';

    protected static ?string $recordTitleAttribute = 'ticket_id';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                TextInput::make('ticket_id')
                    ->rules(['string'])
                    ->placeholder('Ticket Id')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                DatePicker::make('expiry_date')
                    ->rules(['date'])
                    ->placeholder('Expiry Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('status')
                    ->rules(['string'])
                    ->searchable()
                    ->options([
                        'active' => 'Active',
                        'used' => 'Used',
                        'pending' => 'Pending',
                        'expired' => 'Expired',
                    ])
                    ->placeholder('Status')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('created_at')->date()->since(),
                Tables\Columns\TextColumn::make('ticket_id')->searchable()->limit(50),
                Tables\Columns\TextColumn::make('expiry_date')->date(),
                Tables\Columns\TextColumn::make('regionality')->formatStateUsing(function ($state){

                    if($state == 'south_asian')
                    {
                       return 'SAARC Nations';
                    }
                    elseif($state == 'non_south_asian')
                    {
                        return 'Non-SAARC Nations';
                    }
                    else
                    {
                        return '';
                    }

                }),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'expired' => 'warning',
                        'active' => 'success',
                    }),
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
