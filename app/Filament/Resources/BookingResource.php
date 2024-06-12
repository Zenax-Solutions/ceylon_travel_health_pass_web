<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Booking;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\BookingResource\Pages;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Bookings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('package_id')
                        ->rules(['exists:packages,id'])
                        ->required()
                        ->relationship('package', 'main_title')
                        ->searchable()
                        ->placeholder('Package')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('customer_id')
                        ->rules(['exists:customers,id'])
                        ->required()
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
                        ->required()
                        ->placeholder('Adult Pass Count')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('child_pass_count')
                        ->rules([])
                        ->nullable()
                        ->placeholder('Child Pass Count')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('total')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Total')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    KeyValue::make('destination_list')
                        ->required()
                        ->required()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    KeyValue::make('esim_list')
                        ->required()
                        ->required()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    DatePicker::make('date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('payment_status')
                        ->rules(['string'])
                        ->required()
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
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('package.main_title')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('customer.first_name')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('adult_pass_count')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('child_pass_count')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('total')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('date')
                    ->toggleable()
                    ->date(),

            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('package_id')
                    ->relationship('package', 'main_title')
                    ->indicator('Package')
                    ->multiple()
                    ->label('Package'),

                SelectFilter::make('customer_id')
                    ->relationship('customer', 'first_name')
                    ->indicator('Customer')
                    ->multiple()
                    ->label('Customer'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([CreateAction::make()]);
    }

    public static function getRelations(): array
    {
        return [BookingResource\RelationManagers\TicketsRelationManager::class];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'view' => Pages\ViewBooking::route('/{record}'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
