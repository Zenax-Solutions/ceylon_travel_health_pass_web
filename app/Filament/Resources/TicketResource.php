<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Ticket;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\TicketResource\Pages;

class TicketResource extends Resource
{
    protected static ?string $model = Ticket::class;

    protected static ?string $navigationIcon = 'heroicon-o-ticket';

    protected static ?string $navigationGroup = 'Bookings';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('booking_id')
                        ->rules(['exists:bookings,id'])
                        ->required()
                        ->relationship('booking', 'date')
                        ->searchable()
                        ->placeholder('Booking')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 7,
                        ]),

                    TextInput::make('ticket_id')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Ticket Id')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 5,
                        ]),

                    DatePicker::make('expiry_date')
                        ->rules(['date'])
                        ->required()
                        ->placeholder('Expiry Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('status')
                        ->rules(['string'])
                        ->required()
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
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('booking.id')
                    ->toggleable()
                    ->label('Bookig No')
                    ->limit(50),
                Tables\Columns\TextColumn::make('ticket_id')
                    ->toggleable()
                    ->label('Ticket No')
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('expiry_date')
                    ->toggleable()
                    ->date(),
                // Tables\Columns\TextColumn::make('status')
                //     ->toggleable()
                //     ->searchable()
                //     ->enum([
                //         'active' => 'Active',
                //         'used' => 'Used',
                //         'pending' => 'Pending',
                //         'expired' => 'Expired',
                //     ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('booking_id')
                    ->relationship('booking', 'date')
                    ->indicator('Booking')
                    ->multiple()
                    ->label('Booking'),
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
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTickets::route('/'),
            'create' => Pages\CreateTicket::route('/create'),
            'view' => Pages\ViewTicket::route('/{record}'),
            'edit' => Pages\EditTicket::route('/{record}/edit'),
        ];
    }
}
