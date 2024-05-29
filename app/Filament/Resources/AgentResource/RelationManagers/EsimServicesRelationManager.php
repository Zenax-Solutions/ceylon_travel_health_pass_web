<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Filament\Tables\Table;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Resources\RelationManagers\RelationManager;

class EsimServicesRelationManager extends RelationManager
{
    protected static string $relationship = 'esimServices';

    protected static ?string $recordTitleAttribute = 'service_name';

    public function form(Form $form): Form
    {
        return $form->schema([
            Grid::make(['default' => 0])->schema([
                FileUpload::make('image')
                    ->rules(['image', 'max:1024'])
                    ->image()
                    ->placeholder('Image')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 6,
                    ]),

                TextInput::make('service_name')
                    ->rules(['string'])
                    ->placeholder('Service Name')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 7,
                    ]),

                TextInput::make('per_sim_price')
                    ->rules(['numeric'])
                    ->numeric()
                    ->placeholder('Per Sim Price')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 5,
                    ]),

                Select::make('status')
                    ->rules(['string'])
                    ->searchable()
                    ->options([
                        'draft' => 'Draft',
                    ])
                    ->placeholder('Status')
                    ->default('draft')
                    ->columnSpan([
                        'default' => 12,
                        'md' => 12,
                        'lg' => 3,
                    ]),
            ]),
        ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')->rounded(),
                Tables\Columns\TextColumn::make('agent.name')->limit(50),
                Tables\Columns\TextColumn::make('service_name')->limit(50),
                Tables\Columns\TextColumn::make('per_sim_price'),
              
            ])
            ->filters([
                Tables\Filters\Filter::make('created_at')
                    ->form([
                        Forms\Components\DatePicker::make('created_from'),
                        Forms\Components\DatePicker::make('created_until'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['created_from'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '>=',
                                    $date
                                )
                            )
                            ->when(
                                $data['created_until'],
                                fn(
                                    Builder $query,
                                    $date
                                ): Builder => $query->whereDate(
                                    'created_at',
                                    '<=',
                                    $date
                                )
                            );
                    }),

                SelectFilter::make('agent_id')
                    ->multiple()
                    ->relationship('agent', 'name'),
            ])
            ->headerActions([Tables\Actions\CreateAction::make()])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([Tables\Actions\DeleteBulkAction::make()]);
    }
}
