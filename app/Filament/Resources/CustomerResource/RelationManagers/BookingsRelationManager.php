<?php

namespace App\Filament\Resources\CustomerResource\RelationManagers;

use App\Models\Booking;
use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\RelationManagers\RelationManager;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';

    protected static ?string $recordTitleAttribute = 'date';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('package_id')
                    ->rules(['exists:packages,id'])
                    ->relationship('package', 'main_title')
                    ->searchable()
                    ->placeholder('Package')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('adult_pass_count')
                    ->rules([])
                    ->placeholder('Adult Pass Count')
                    ->default('0')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('child_pass_count')
                    ->rules([])
                    ->placeholder('Child Pass Count')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                TextInput::make('total')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Total')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 4,
                    ]),

                KeyValue::make('destination_list')
                    ->required()
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                KeyValue::make('esim_list')
                    ->required()
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 12,
                    ]),

                DatePicker::make('date')
                    ->rules(['date'])
                    ->placeholder('Date')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                Select::make('payment_status')
                    ->rules(['string'])
                    ->searchable()
                    ->options([
                        'pending' => 'Pending',
                        'declined' => 'Declined',
                        'canceled' => 'Canceled',
                        'paid' => 'Paid',
                    ])
                    ->placeholder('Payment Status')
                    ->default('pending')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('id')
                   
                ->label('Booking No')
                ->formatStateUsing(function ($state) {
                    return '#'.$state;
                })
                ->searchable()
                ->limit(50),
            Tables\Columns\TextColumn::make('package.main_title')
                ->toggleable()
                ->searchable()
                ->limit(50),
            Tables\Columns\TextColumn::make('id')
                ->formatStateUsing(function (Booking $record, $state) {
                    if($record->customer != null)
                    {
                       return $record->customer != null ? '#'.$state.'  -> '. $record->customer->first_name . ' ' . $record->customer->last_name : '';
                    }
                    else
                    { 
                        return $record->agent != null ?  '#'.$state.'  -> '. $record->agent->name .' ( Tourism Agent ✅ )' : '';
                    }
                })
              
                ->label('Booking Info')
                ->searchable()
                ->limit(50),
            Tables\Columns\TextColumn::make('adult_pass_count')
                ->toggleable()
                ->limit(50),
            Tables\Columns\TextColumn::make('child_pass_count')
                ->toggleable()
                ->limit(50),
            Tables\Columns\TextColumn::make('total')
                ->toggleable(),
            Tables\Columns\TextColumn::make('date')
                ->toggleable()
                ->date(),
            Tables\Columns\TextColumn::make('payment_status')
                ->badge()
                ->color(fn (string $state): string => match ($state) {
                    'pending' => 'danger',
                    'paid' => 'success',
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

                SelectFilter::make('package_id')
                    ->multiple()
                    ->relationship('package', 'main_title'),

                SelectFilter::make('customer_id')
                    ->multiple()
                    ->relationship('customer', 'first_name'),
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
                ExportBulkAction::make()
                ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                //Tables\Actions\DeleteBulkAction::make()
                ]);
    }
}
