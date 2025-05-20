<?php

namespace App\Filament\Tenants\Resources;

use App\Filament\Tenants\Resources\SubscriptionsResource\Pages;
use App\Filament\Tenants\Resources\SubscriptionsResource\RelationManagers;
use App\Models\SubscriptionPackage;
use App\Models\Subscriptions;
use App\Models\TenantSubscriptionLog;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Forms\Set;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Support\Colors\Color;
use Filament\Support\Facades\FilamentColor;
use Illuminate\Support\Facades\Auth;

class SubscriptionsResource extends Resource
{
    protected static ?string $model = TenantSubscriptionLog::class;

    protected static ?string $navigationLabel = "Subscriptions";
    protected static ?string $label = "Subscriptions";

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';


    public static function form(Form $form): Form
    {
        return $form
            ->schema(TenantSubscriptionLog::getForm($form));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([

                TextColumn::make('name')
                    ->badge(),
                TextColumn::make('message_balance'),
                TextColumn::make('created_at')
                    ->dateTime(),
            ])
            ->filters([])
            ->actions([
//                Tables\Actions\DeleteAction::make(),
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
//        dd( auth('tenant')->id());
        return parent::getEloquentQuery()
            ->where('tenant_id', auth('tenant')->id());
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListSubscriptions::route('/'),
//            'create' => Pages\CreateSubscriptions::route('/create'),
//            'edit' => Pages\EditSubscriptions::route('/{record}/edit'),
        ];
    }
}
