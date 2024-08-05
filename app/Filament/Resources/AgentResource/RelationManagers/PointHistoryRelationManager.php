<?php

namespace App\Filament\Resources\AgentResource\RelationManagers;

use App\Filament\Filters\DateRangeFilter;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Tables\Actions\BulkAction;
use Illuminate\Database\Eloquent\Collection;
use Filament\Tables\Columns\Summarizers\Sum;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;

class PointHistoryRelationManager extends RelationManager
{
    protected static string $relationship = 'pointHistory';

    public static function canViewForRecord(Model $ownerRecord, string $pageClass): bool
    {
        return $ownerRecord->type === 'tour_agent';
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('agent_id')
                    ->required()
                    ->maxLength(255),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('agent_id')
            ->columns([
                Tables\Columns\TextColumn::make('agent.name'),
                Tables\Columns\TextColumn::make('points')->summarize(Sum::make()->money('USD')->label('Total'))->money('USD'),
                Tables\Columns\TextColumn::make('date'),
                Tables\Columns\TextColumn::make('paid_status')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'pending' => 'danger',
                        'paid' => 'success',
                    })->icon(fn (string $state): string => match ($state) {
                        'pending' => 'heroicon-o-arrow-path',
                        'paid' => 'heroicon-o-check-badge',
                    }),
            ])
            ->filters([
                DateRangeFilter::make('created_at'),
            ])
            ->headerActions([
                //Tables\Actions\CreateAction::make(),
                ExportBulkAction::make(),
            ])
            ->actions([
                //Tables\Actions\EditAction::make(),
                //Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //Tables\Actions\DeleteBulkAction::make(),

                    BulkAction::make('Paid')
                        ->action(function (Collection $selectedRecords) {
                            $selectedRecords->each(
                                fn (Model $selectedRecord) => $selectedRecord->update([
                                    'paid_status' => 'paid',
                                ]),
                            );
                        })->icon('heroicon-o-check-badge')->color('success'),

                    BulkAction::make('Pending')
                        ->action(function (Collection $selectedRecords) {
                            $selectedRecords->each(
                                fn (Model $selectedRecord) => $selectedRecord->update([
                                    'paid_status' => 'pending',
                                ]),
                            );
                        })->icon('heroicon-o-arrow-top-right-on-square')->color('danger'),


                ]),
            ]);
    }
}
