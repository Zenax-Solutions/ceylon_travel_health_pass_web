<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\Destination;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\DestinationResource\Pages;
use App\Filament\Resources\DestinationResource\RelationManagers\DestinationStockRelationManager;
use Filament\Forms\Components\Toggle;
use Filament\Support\RawJs;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class DestinationResource extends Resource
{
    protected static ?string $model = Destination::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';

    protected static ?string $recordTitleAttribute = 'destination';

    protected static ?string $navigationGroup = 'Destinations';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    Select::make('city_id')
                        ->rules(['exists:cities,id'])
                        ->required()
                        ->relationship('city', 'name')
                        ->searchable()
                        ->placeholder('City')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    FileUpload::make('image')
                        ->rules(['image', 'max:1024'])
                        ->nullable()
                        ->image()
                        ->placeholder('Image')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),
                    TextInput::make('branch_number')
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('destination')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Destination')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    // TextInput::make('location')
                    //     ->rules(['string'])
                    //     ->nullable()
                    //     ->placeholder('Location')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 6,
                    //     ]),

                    TextInput::make('south_asian_price')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->prefix('$')
                        ->placeholder('South Asian Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('non_south_asian_price')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->prefix('$')
                        ->placeholder('Non South Asian Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('child_south_asian_price')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->prefix('$')
                        ->placeholder('Child South Asian Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('child_non_south_asian_price')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->mask(RawJs::make('$money($input)'))
                        ->stripCharacters(',')
                        ->prefix('$')
                        ->placeholder('Child Non South Asian Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),
                        TextInput::make('discount_info')
                        ->placeholder('Discount Message')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),
                        Toggle::make('is_wildlife')
                        ->label("Wildlife Destination")
                        ->onColor('success')
                        ->offColor('danger')->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    // TextInput::make('discount_price')
                    //     ->rules(['numeric'])
                    //     ->nullable()
                    //     ->numeric()
                    //     ->placeholder('Discount Price')
                    //     ->default('0')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 4,
                    //     ]),

                    // TextInput::make('stock_count')
                    //     ->rules(['numeric'])
                    //     ->required()
                    //     ->default('0')
                    //     ->debounce('2s')
                    //     ->afterStateUpdated(fn ($state, callable $set) => $set('current_stock_count', $state))
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 4,
                    //     ]),

                    // TextInput::make('current_stock_count')
                    //     ->rules(['numeric'])
                    //     ->required()
                    //     ->readOnly()
                    //     ->default('0')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 4,
                    //     ]),

                    Select::make('status')
                        ->rules(['string'])
                        ->required()
                        ->searchable()
                        ->options([
                            'draft' => 'Draft',
                            'publish' => 'Publish',
                        ])
                        ->placeholder('Status')
                        ->default('draft')
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
                Tables\Columns\ImageColumn::make('image')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\TextColumn::make('branch_number')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('destination')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('city.name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('south_asian_price')
                    ->money('USD')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('non_south_asian_price')
                    ->money('USD')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('child_south_asian_price')
                    ->money('USD')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('child_non_south_asian_price')
                    ->money('USD')
                    ->toggleable(),
                Tables\Columns\ToggleColumn::make('is_wildlife')->label("Wildlife Destination"),    
                Tables\Columns\TextColumn::make('stock_count')
                    ->label('Ticket stock count')
                    ->formatStateUsing(fn (Destination $record): string => $record->destinationStock()->orderBy('id', 'desc')->firstOr(function () {
                        return (object) ['ticket_stock_count' => 'stock not available'];
                    })->ticket_stock_count)
                    ->badge()
                    ->color('warning')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('current_stock_count')
                    ->label('Sold ticket count')
                    ->formatStateUsing(fn (Destination $record): string => $record->destinationStock()->orderBy('id', 'desc')->firstOr(function () {
                        return (object) ['selling_ticket_count' => 'stock not available'];
                    })->selling_ticket_count)
                    ->badge()
                    ->color('danger')
                    ->toggleable(),
                    Tables\Columns\TextColumn::make('id')
                    ->label('Over selling count')
                    ->formatStateUsing(fn (Destination $record): string => $record->destinationStock()->orderBy('id', 'desc')->firstOr(function () {
                        return (object) ['over_selling' => 'stock not available'];
                    })->over_selling)
                    ->badge()
                    ->color('danger')
                    ->toggleable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'draft' => 'gray',
                        'publish' => 'success',
                    })

            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('city_id')
                    ->relationship('city', 'name')
                    ->indicator('City')
                    ->label('City'),
            ])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([
                CreateAction::make(),
                ExportBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            DestinationStockRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDestinations::route('/'),
            'create' => Pages\CreateDestination::route('/create'),
            'view' => Pages\ViewDestination::route('/{record}'),
            'edit' => Pages\EditDestination::route('/{record}/edit'),
        ];
    }
}
