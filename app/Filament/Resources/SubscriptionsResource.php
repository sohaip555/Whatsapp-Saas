<?php

namespace App\Filament\Resources;

use App\Filament\Resources\SubscriptionsResource\Pages;
use App\Filament\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Resources\SubscriptionsResource\Widgets\TokensTable;
use App\Models\SubscriptionPackage;
use App\Models\Tenant;
use App\Models\TenantSubscriptionLog;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class SubscriptionsResource extends Resource
{
    protected static ?string $model = TenantSubscriptionLog::class;

    protected static ?string $navigationIcon = 'heroicon-o-users';
    protected static ?string $navigationGroup = 'Subscriptions';

    protected static ?string $label = "Subscriptions";


    protected static ?int $sort = 1;



    public static function form(Form $form): Form
    {
        return $form
            ->schema(TenantSubscriptionLog::getForm());
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema(TenantSubscriptionLog::getMyInfolist());
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->searchable(),
                TextColumn::make('tenant.name')
                    ->searchable(),
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
            ->filters([
                SelectFilter::make('subscription_package_id')
                    ->label('Package')
                    ->options(SubscriptionPackage::all()->pluck('name', 'id')),
                SelectFilter::make('tenant_id')
                    ->label('Tenant')
                    ->options(Tenant::all()->pluck('name', 'id')),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getWidgets(): array
    {
        return [
//            SubscriptionsStats::class,
//            TokensTable::class,
        ];
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
            'index' => Pages\ListSubscriptions::route('/'),
            'view' => Pages\ViewSubscriptions::route('/{record}'),
//            'create' => Pages\CreateSubscriptions::route('/create'),
//            'edit' => Pages\EditSubscriptions::route('/{record}/edit'),
        ];
    }
}
