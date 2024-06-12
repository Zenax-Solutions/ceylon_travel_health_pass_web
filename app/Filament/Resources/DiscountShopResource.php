<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DiscountShop;
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
use App\Filament\Resources\DiscountShopResource\Pages;

class DiscountShopResource extends Resource
{
    protected static ?string $model = DiscountShop::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Services';

    protected static ?string $recordTitleAttribute = 'shope_name';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    public static function form(Form $form): Form
    {
        return $form->schema([
            Section::make()->schema([
                Grid::make(['default' => 0])->schema([
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

                    Select::make('agent_id')
                        ->rules(['exists:agents,id'])
                        ->required()
                        ->relationship('agent', 'name')
                        ->searchable()
                        ->placeholder('Agent')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('shope_name')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Shope Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 7,
                        ]),

                    TextInput::make('location')
                        ->rules(['string'])
                        ->label('Location ( Map Link )')
                        ->required()
                        ->placeholder('Location')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 5,
                        ]),

                    TextInput::make('area')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Area')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('discount_amount')
                        ->rules(['string'])
                        ->prefix('%')
                        ->required()
                        ->placeholder('Discount Amount')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    Select::make('status')
                        ->rules(['string'])
                        ->nullable()
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
                Tables\Columns\ImageColumn::make('image')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\TextColumn::make('agent.name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('shope_name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('area')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('discount_amount')
                    ->suffix('%')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->limit(50),
                // Tables\Columns\TextColumn::make('status')
                //     ->toggleable()
                //     ->searchable()
                //     ->enum([
                //         'draft' => 'Draft',
                //         'publish' => 'Publish',
                //     ]),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('agent_id')
                    ->relationship('agent', 'name')
                    ->indicator('Agent')
                    ->multiple()
                    ->label('Agent'),
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
            'index' => Pages\ListDiscountShops::route('/'),
            'create' => Pages\CreateDiscountShop::route('/create'),
            'view' => Pages\ViewDiscountShop::route('/{record}'),
            'edit' => Pages\EditDiscountShop::route('/{record}/edit'),
        ];
    }
}
