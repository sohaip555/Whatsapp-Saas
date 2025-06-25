<?php

namespace App\Filament\Companies\Resources;

use App\Filament\Companies\Resources\SubscriptionsResource\Pages;
use App\Filament\Companies\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Companies\Resources\SubscriptionsResource\Widgets\TokensTable;
use App\Models\CompanySubscriptionLog;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;

class SubscriptionsResource extends Resource
{
    protected static ?string $model = CompanySubscriptionLog::class;
    protected static ?int $sort = 1;

    protected static ?string $label = "Subscriptions";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Subscriptions';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(CompanySubscriptionLog::getForm());
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema(CompanySubscriptionLog::getMyInfolist());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name'),
                TextColumn::make('subscriptionPackage.name')
                    ->label('Package Name')
                    ->badge()
                    ->color(function ($state) {
                        return $state;
                    }),
                TextColumn::make('message_balance'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getEloquentQuery(): Builder
    {
        return parent::getEloquentQuery()
            ->where('company_id', auth()->user()->company_id);
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'view' => Pages\ViewSubscriptions::route('/{record}'),
//            'create' => Pages\CreateSubscriptions::route('/create'),
//            'edit' => Pages\EditSubscriptions::route('/{record}/edit'),
        ];
    }
}
