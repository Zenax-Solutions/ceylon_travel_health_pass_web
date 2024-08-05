<?php

namespace App\Filament\Resources;

use App\Filament\Filters\DateRangeFilter;
use Filament\Tables\Filters\SelectFilter;
use App\Filament\Resources\PointsHistoryResource\Pages;
use App\Models\PointsHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;


class PointsHistoryResource extends Resource
{
    protected static ?string $model = PointsHistory::class;

    protected static ?string $navigationLabel  = 'Points record history';

    protected static ?string $navigationGroup = 'Tourism agent point records';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->numeric(),
                Forms\Components\TextInput::make('points')
                    ->required()
                    ->numeric()
                    ->default(0),
                Forms\Components\DatePicker::make('date')
                    ->required(),
                Forms\Components\Select::make('paid_status')
                    ->options([
                        'pending' => 'Pending',
                        'paid' => 'Paid',
                    ])
                    ->default('pending'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('agent.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('points')->money('USD')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('paid_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'danger',
                        'paid' => 'success',
                    })->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-arrow-path',
                        'paid' => 'heroicon-o-check-badge',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])


            ->filters([
                DateRangeFilter::make('created_at'),

                SelectFilter::make('agent.name')
                    ->relationship('agent', 'name', function (Builder $query) {
                        $query->where(function ($query) {
                            $query->where('type', 'tour_agent');
                        });
                    })
                    ->indicator('Agent')
                    ->label('Tourism Agent List')->searchable(),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    // Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPointsHistories::route('/'),
            //'create' => Pages\CreatePointsHistory::route('/create'),
            //'edit' => Pages\EditPointsHistory::route('/{record}/edit'),
        ];
    }
}
