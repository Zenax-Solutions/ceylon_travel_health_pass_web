<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Livewire\Component;
use App\Models\Customer;
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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Filters\DateRangeFilter;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Support\Facades\Hash;
use App\Filament\Resources\CustomerResource\Pages;

class CustomerResource extends Resource
{
    protected static ?string $model = Customer::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';

    protected static ?string $navigationGroup = 'Actors';

    // public static function getNavigationBadge(): ?string
    // {
    //     return static::getModel()::count();
    // }

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
                            'lg' => 12,
                        ]),

                    TextInput::make('first_name')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('First Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('last_name')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Last Name')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('email')
                        ->rules(['email'])
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->email()
                        ->placeholder('Email')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 7,
                        ]),

                    TextInput::make('password')
                        ->password()
                        ->placeholder('Password')
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 5,
                        ]),

                    Select::make('region_type')
                        ->rules(['string'])
                        ->required()
                        ->searchable()
                        ->options([
                            'south_asian' => 'SAARC Nations',
                            'non_south_asian' => 'Non-SAARC Nations',
                        ])
                        ->placeholder('Region Type')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('contact_no')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Contact No')
                        ->unique(ignoreRecord: true)
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('whatsapp_no')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Whatsapp No')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    RichEditor::make('address')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Address')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),


                    ToggleButtons::make('status')
                        ->options([
                            'suspended' => 'Suspended',
                            'active' => 'Active',
                        ])->colors([
                            'suspended' => 'danger',
                            'active' => 'success',
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
                Tables\Columns\TextColumn::make('first_name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('last_name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('email')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                // Tables\Columns\TextColumn::make('region_type')
                //     ->toggleable()
                //     ->searchable()
                //     ->enum([
                //         'south_asian' => 'South Asian',
                //         'non_south_asian' => 'Non South Asian',
                //     ]),
                Tables\Columns\TextColumn::make('contact_no')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                // Tables\Columns\TextColumn::make('whatsapp_no')
                //     ->toggleable()
                //     ->searchable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('address')
                //     ->toggleable()
                //     ->limit(50),
                Tables\Columns\TextColumn::make('created_at')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'suspended' => 'danger',
                        'active' => 'success',
                    }),
            ])
            ->filters([DateRangeFilter::make('created_at')])
            ->actions([
                ViewAction::make(),
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->headerActions([

                //CreateAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            // CustomerResource\RelationManagers\BookingsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCustomers::route('/'),
            'create' => Pages\CreateCustomer::route('/create'),
            'view' => Pages\ViewCustomer::route('/{record}'),
            'edit' => Pages\EditCustomer::route('/{record}/edit'),
        ];
    }
}
