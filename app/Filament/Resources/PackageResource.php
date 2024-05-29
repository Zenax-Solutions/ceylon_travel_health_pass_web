<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Package;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Section;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Forms\Components\RichEditor;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\PackageResource\Pages;
use App\Models\DiscountService;
use Filament\Forms\Components\Select;
use App\Models\DiscountShop;
use Filament\Forms\Components\FileUpload;

class PackageResource extends Resource
{
    protected static ?string $model = Package::class;

    protected static ?string $navigationIcon = 'heroicon-o-cube';

    protected static ?string $recordTitleAttribute = 'main_title';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
                    TextInput::make('main_title')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Main Title')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('second_title')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Second Title')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),
                    FileUpload::make('gallery')
                        ->label('Gallery Images')
                        ->multiple()
                        ->openable()
                        ->reorderable()
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),
                    RichEditor::make('description')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Description')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('travel_info')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Travel Info')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    RichEditor::make('health_info')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Health Info')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    TextInput::make('days')
                        ->rules([])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Days')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 3,
                        ]),

                    TextInput::make('expire_days_count')
                        ->rules([])
                        ->required()
                        ->numeric()
                        ->placeholder('Expire Days Count')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('price')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 5,
                        ]),

                    TextInput::make('child_price')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Child Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('additional_per_adult_price')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Additional Per Adult Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('additional_per_day_price')
                        ->rules(['numeric'])
                        ->nullable()
                        ->numeric()
                        ->placeholder('Additional Per Day Price')
                        ->default('0')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    Select::make('discount_shop_list')
                        ->multiple()
                        ->searchable()
                        ->getSearchResultsUsing(fn (string $search): array => DiscountShop::where('shope_name', 'like', "%{$search}%")->limit(50)->pluck('shope_name', 'id')->toArray())
                        ->getOptionLabelsUsing(fn (array $values): array => DiscountShop::whereIn('id', $values)->pluck('shope_name', 'id')->toArray())
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),


                    Select::make('discount_service_list')
                        ->multiple()
                        ->searchable()
                        ->getSearchResultsUsing(fn (string $search): array => DiscountService::where('service_name', 'like', "%{$search}%")->limit(50)->pluck('service_name', 'id')->toArray())
                        ->getOptionLabelsUsing(fn (array $values): array => DiscountService::whereIn('id', $values)->pluck('service_name', 'id')->toArray())
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),
                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('main_title')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('second_title')
                    ->toggleable()
                    ->searchable(true, null, true)
                    ->limit(50),
                Tables\Columns\TextColumn::make('description')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('travel_info')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('health_info')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('days')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('expire_days_count')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('price')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('child_price')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('additional_per_adult_price')
                    ->toggleable()
                    ->searchable(true, null, true),
                Tables\Columns\TextColumn::make('additional_per_day_price')
                    ->toggleable()
                    ->searchable(true, null, true),
            ])
            ->filters([DateRangeFilter::make('created_at')])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([CreateAction::make()]);
    }

    public static function getRelations(): array
    {
        return [
            PackageResource\RelationManagers\BookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPackages::route('/'),
            'create' => Pages\CreatePackage::route('/create'),
            'view' => Pages\ViewPackage::route('/{record}'),
            'edit' => Pages\EditPackage::route('/{record}/edit'),
        ];
    }
}
