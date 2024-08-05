<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\Agent;
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
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use App\Filament\Filters\DateRangeFilter;
use App\Filament\Resources\AgentResource\Pages;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Get;
use Illuminate\Support\Facades\Hash;
use Filament\Support\RawJs;
use Illuminate\Database\Eloquent\Builder;

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

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
                    Select::make('type')
                        ->rules(['string'])
                        ->required()
                        ->searchable()
                        ->options([
                            'discount_agent' => 'Discount Agent',
                            'service_agent' => 'Service Agent',
                            'esim_agent' => 'Esim Agent',
                            'tour_agent' => 'Tour Agent',
                        ])
                        ->placeholder('Type')
                        ->live()
                        ->afterStateUpdated(fn (Select $component) => $component
                            ->getContainer()
                            ->getComponent('dynamicTypeFields')
                            ->getChildComponentContainer()
                            ->fill())
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    FileUpload::make('profile_image')
                        ->rules(['image', 'max:1024'])
                        ->nullable()
                        ->image()
                        ->placeholder('Profile Image')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('name')
                        ->rules(['string'])
                        ->required()
                        ->placeholder('Name')
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
                            'lg' => 6,
                        ]),

                    RichEditor::make('contact_no')
                        ->rules(['string'])
                        ->required()
                        ->unique(ignoreRecord: true)
                        ->placeholder('Contact No')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('id_no')
                        ->rules(['string'])
                        ->nullable()
                        ->label('ID Number')
                        ->placeholder('Id No')
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
                    RichEditor::make('bank_details')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Bank Details')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 12,
                        ]),

                    Section::make('Tour Agent')
                        ->schema(fn (Get $get): array => match ($get('type')) {
                            'tour_agent' => [

                                TextInput::make('license_no')
                                    ->rules(['string'])
                                    ->nullable()
                                    ->label('Tourism License Number')
                                    ->placeholder('License No')
                                    ->required()
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 4,
                                    ]),

                                TextInput::make('agent_discount_margin')
                                    ->helperText('Default Agent Margin is '.env('AGENT_DISCONUNT_MARGIN', 0))
                                    ->rules(['numeric'])
                                    ->numeric()
                                    ->mask(RawJs::make('$money($input)'))
                                    ->stripCharacters(',')
                                    ->prefix('$')
                                    ->placeholder('Default 5 USD')
                                    ->minValue(env('AGENT_DISCONUNT_MARGIN', 0))
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 5,
                                    ]),
                                // TextInput::make('points')
                                //     ->rules([])
                                //     ->nullable()
                                //     ->placeholder('Points')
                                //     ->columnSpan([
                                //         'default' => 12,
                                //         'md' => 12,
                                //         'lg' => 4,
                                //     ]),


                                TextInput::make('coupon_code')
                                    ->rules(['string'])
                                    ->disabled()
                                    ->placeholder('Auto Generated')
                                    ->columnSpan([
                                        'default' => 12,
                                        'md' => 12,
                                        'lg' => 3,
                                    ]),

                            ],
                            default => [],
                        })
                        ->key('dynamicTypeFields'),


                    Section::make('Login Password')->schema([

                        TextInput::make('password')
                            ->password()
                            ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                            ->dehydrated(fn (?string $state): bool => filled($state))
                            ->required(fn (string $operation): bool => $operation === 'create')
                            ->placeholder('New Login Password')
                    ])->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),

                    // TextInput::make('commission')
                    //     ->rules([])
                    //     ->nullable()
                    //     ->placeholder('Commission')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 4,
                    //     ]),

                    // TextInput::make('commission_payment_status')
                    //     ->rules(['string'])
                    //     ->nullable()
                    //     ->placeholder('Commission Payment Status')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 4,
                    //     ]),

                    // DatePicker::make('commission_payment_date')
                    //     ->rules(['date'])
                    //     ->nullable()
                    //     ->placeholder('Commission Payment Date')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 6,
                    //     ]),

                    // DatePicker::make('recent_commission_payment_date')
                    //     ->rules(['date'])
                    //     ->nullable()
                    //     ->placeholder('Recent Commission Payment Date')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 6,
                    //     ]),

                    // RichEditor::make('recent_info')
                    //     ->rules(['string'])
                    //     ->nullable()
                    //     ->placeholder('Recent Info')
                    //     ->columnSpan([
                    //         'default' => 12,
                    //         'md' => 12,
                    //         'lg' => 6,
                    //     ]),


                ]),
            ]),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                Tables\Columns\ImageColumn::make('profile_image')
                    ->toggleable()
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->toggleable()
                    ->searchable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('email')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('contact_no')
                    ->toggleable()
                    ->html()
                    ->limit(50),
                // Tables\Columns\TextColumn::make('id_no')
                //     ->toggleable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('license_no')
                //     ->toggleable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('points')
                //     ->toggleable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('commission')
                //     ->toggleable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('commission_payment_status')
                //     ->toggleable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('commission_payment_date')
                //     ->toggleable()
                //     ->date(),
                // Tables\Columns\TextColumn::make(
                //     'recent_commission_payment_date'
                // )
                //     ->toggleable()
                //     ->date(),
                // Tables\Columns\TextColumn::make('recent_info')
                //     ->toggleable()
                //     ->limit(50),
                // Tables\Columns\TextColumn::make('coupon_code')
                //     ->toggleable()
                //     ->limit(50),
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
            // AgentResource\RelationManagers\DiscountShopsRelationManager::class,
            // AgentResource\RelationManagers\DiscountServicesRelationManager::class,
            // AgentResource\RelationManagers\EsimServicesRelationManager::class,
            AgentResource\RelationManagers\PointHistoryRelationManager::class,
        ];
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAgents::route('/'),
            'create' => Pages\CreateAgent::route('/create'),
            'view' => Pages\ViewAgent::route('/{record}'),
            'edit' => Pages\EditAgent::route('/{record}/edit'),
        ];
    }
}
