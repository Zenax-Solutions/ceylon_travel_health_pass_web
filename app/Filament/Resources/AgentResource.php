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

class AgentResource extends Resource
{
    protected static ?string $model = Agent::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationGroup = 'Actors';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

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
                        ->placeholder('Id No')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('license_no')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('License No')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
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

                    TextInput::make('points')
                        ->rules([])
                        ->nullable()
                        ->placeholder('Points')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('commission')
                        ->rules([])
                        ->nullable()
                        ->placeholder('Commission')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    TextInput::make('commission_payment_status')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Commission Payment Status')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 4,
                        ]),

                    DatePicker::make('commission_payment_date')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Commission Payment Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    DatePicker::make('recent_commission_payment_date')
                        ->rules(['date'])
                        ->nullable()
                        ->placeholder('Recent Commission Payment Date')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    RichEditor::make('recent_info')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Recent Info')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 6,
                        ]),

                    TextInput::make('coupon_code')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Coupon Code')
                        ->columnSpan([
                            'default' => 12,
                            'md' => 12,
                            'lg' => 3,
                        ]),

                    TextInput::make('status')
                        ->rules(['string'])
                        ->nullable()
                        ->placeholder('Status')
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
                Tables\Columns\TextColumn::make('id_no')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('license_no')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('points')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('commission')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('commission_payment_status')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('commission_payment_date')
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make(
                    'recent_commission_payment_date'
                )
                    ->toggleable()
                    ->date(),
                Tables\Columns\TextColumn::make('recent_info')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('coupon_code')
                    ->toggleable()
                    ->limit(50),
                Tables\Columns\TextColumn::make('status')
                    ->toggleable()
                    ->limit(50),
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
            AgentResource\RelationManagers\DiscountShopsRelationManager::class,
            AgentResource\RelationManagers\DiscountServicesRelationManager::class,
            AgentResource\RelationManagers\EsimServicesRelationManager::class,
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
