<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\DiscountService;
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
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use App\Filament\Resources\DiscountServiceResource\Pages;


class DiscountServiceResource extends Resource
{
    protected static ?string $model = DiscountService::class;

    protected static ?string $navigationIcon = 'heroicon-o-tag';

    protected static ?string $navigationGroup = 'Services';

    protected static ?string $recordTitleAttribute = 'service_name';

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

                    TextInput::make('service_name')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Service Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 7,
                        ]),

                    TextInput::make('location')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Location')
                        ->label('Location ( Map Link )')
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

                    ToggleButtons::make('status')
                        ->options([
                            'pending' => 'Pending',
                            'publish' => 'Approved'
                        ])->colors([
                            'pending' => 'danger',
                            'publish' => 'success',
                        ])->default('pending')->columnSpan([
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
                Tables\Columns\TextColumn::make('agent.name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('service_name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('area')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('discount_amount')
                    ->toggleable()
                    ->suffix('%')
                    ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->formatStateUsing(function (string $state): string {

                        if ($state == 'publish') {
                            return 'Approved';
                        } else {
                            return 'Pending';
                        }
                    })
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'danger',
                        'publish' => 'success',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->limit(50),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('agent_id')
                    ->relationship('agent', 'name', function (Builder $query) {
                        $query->where(function ($query) {
                            $query->where('type', 'service_agent');
                        });
                    })
                    ->indicator('Agent')
                    ->label('Service Agent'),
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
            'index' => Pages\ListDiscountServices::route('/'),
            'create' => Pages\CreateDiscountService::route('/create'),
            'view' => Pages\ViewDiscountService::route('/{record}'),
            'edit' => Pages\EditDiscountService::route('/{record}/edit'),
        ];
    }
}
