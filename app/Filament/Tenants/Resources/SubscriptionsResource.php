<?php

namespace App\Filament\Tenants\Resources;

use App\Filament\Tenants\Resources\SubscriptionsResource\Pages;
use App\Filament\Tenants\Resources\SubscriptionsResource\Widgets\SubscriptionsStats;
use App\Filament\Tenants\Resources\SubscriptionsResource\Widgets\TokensTable;
use App\Models\TenantSubscriptionLog;
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
    protected static ?string $model = TenantSubscriptionLog::class;
    protected static ?int $sort = 1;

    protected static ?string $navigationLabel = "Subscriptions";
    protected static ?string $label = "Subscriptions";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(TenantSubscriptionLog::getForm());
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Subscription Details')
                    ->columns(2)
                    ->schema([
                        TextEntry::make('name')
                            ->label('Name'),

                        TextEntry::make('subscriptionPackage.name')
                            ->label('Package Name')
                        ->badge()
                        ->color(function ($state) {
                            return $state;
                        }),

                        TextEntry::make('message_balance')
                            ->label('Message Balance'),
                    ]),

//                Section::make('Metadata')
//                    ->columns(2)
//                    ->schema([
//                        TextEntry::make('created_at')
//                            ->label('Created At')
//                            ->dateTime(),
//
//                        TextEntry::make('updated_at')
//                            ->label('Updated At')
//                            ->dateTime(),
//                    ]),
            ]);
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
            ->filters([
                //
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
            ->where('tenant_id', auth('tenant')->id());
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
            'view' => Pages\ViewTokens::route('/{record}'),
//            'create' => Pages\CreateSubscriptions::route('/create'),
//            'edit' => Pages\EditSubscriptions::route('/{record}/edit'),
        ];
    }
}
