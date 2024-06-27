<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use App\Models\EsimService;
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
use App\Filament\Resources\EsimServiceResource\Pages;

class EsimServiceResource extends Resource
{
    protected static ?string $model = EsimService::class;

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

                    TextInput::make('per_sim_price')
                        ->rules(['numeric'])
                        ->required()
                        ->numeric()
                        ->placeholder('Per Sim Price')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 5,
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
                    ->limit(50),
                Tables\Columns\TextColumn::make('service_name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('per_sim_price')
                    ->toggleable(),
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
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
            ])
            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('agent_id')
                    ->relationship('agent', 'name', function (Builder $query) {
                        $query->where(function ($query) {
                            $query->where('type', 'esim_agent');
                        });
                    })
                    ->indicator('Agent')
                    ->label('Esim Agent'),
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

    public static function canViewAny(): bool
    {
        return false;
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEsimServices::route('/'),
            'create' => Pages\CreateEsimService::route('/create'),
            'view' => Pages\ViewEsimService::route('/{record}'),
            'edit' => Pages\EditEsimService::route('/{record}/edit'),
        ];
    }
}
