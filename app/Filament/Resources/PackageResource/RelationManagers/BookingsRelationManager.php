<?php

namespace App\Filament\Resources\PackageResource\RelationManagers;

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

class BookingsRelationManager extends RelationManager
{
    protected static string $relationship = 'bookings';

    protected static ?string $recordTitleAttribute = 'date';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                Select::make('customer_id')
                    ->rules(['exists:customers,id'])
                    ->relationship('customer', 'first_name')
                    ->searchable()
                    ->placeholder('Customer')
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
                Tables\Columns\TextColumn::make('package.main_title')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('customer.first_name')->limit(
                    50
                ),
                Tables\Columns\TextColumn::make('adult_pass_count')->limit(50),
                Tables\Columns\TextColumn::make('child_pass_count')->limit(50),
                Tables\Columns\TextColumn::make('total'),
                Tables\Columns\TextColumn::make('date')->date(),
                // Tables\Columns\TextColumn::make('payment_status')->enum([
                //     'pending' => 'Pending',
                //     'declined' => 'Declined',
                //     'canceled' => 'Canceled',
                //     'paid' => 'Paid',
                // ]),
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
                                fn (
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
                                fn (
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
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
