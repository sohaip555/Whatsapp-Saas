<?php

namespace App\Filament\Tenants\Resources;

use App\Filament\Tenants\Resources\SubscriptionsResource\Pages\ViewTokens;
use App\Filament\Tenants\Resources\TokensResource\Pages;
use App\Filament\Tenants\Resources\TokensResource\Pages\ViewToken;
use App\Filament\Tenants\Resources\TokensResource\RelationManagers;
use App\Filament\Tenants\Resources\TokensResource\Widgets\MessagesTable;
use App\Models\token;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Unique;
use Illuminate\Validation\ValidationException;

class TokensResource extends Resource
{
    protected static ?string $model = token::class;

    protected static ?int $sort = 2;


    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'TokensTable';
    protected static ?string $pluralModelLabel = 'TokensTable';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(token::getForm());
    }

    public static function infolist(\Filament\Infolists\Infolist $infolist): \Filament\Infolists\Infolist
    {
        return $infolist
            ->schema([
                Section::make('Token Info')
                    ->schema([
                        TextEntry::make('tenant_subscription_log_id')
                            ->label('Subscription Log')
                            ->formatStateUsing(fn ($state, $record) => $record->tenantSubscriptionLog?->name ?? 'N/A'),

                        TextEntry::make('isActive')
                            ->label('Status')
                            ->formatStateUsing(fn (bool $state) => $state ? 'Active' : 'Inactive')
                            ->badge()
                            ->color(function ($state) {
                                return $state ? 'success' : 'danger';
                            }),


                        TextEntry::make('token')
                            ->label('Token'),

//                        TextEntry::make('created_at')
//                            ->label('Created At')
//                            ->dateTime(),
//
//                        TextEntry::make('updated_at')
//                            ->label('Last Updated')
//                            ->dateTime(),
                    ])
                    ->columns(2),
            ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns(
                token::getMyTable()
            )
            ->filters([
//                Tables\Filters\Filter::make('isActive')
//                    ->label('Show Only the Token is Active')
//                    ->query(function ($query)
//                    {
//                        $query->where('isActive', 1);
//                    }),
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
//                Tables\Actions\DeleteAction::make()
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
            ->whereHas('tenantSubscriptionLog', function ($query) {
                $query->where('tenant_id', auth('tenant')->id());
            });
    }

    public static function getWidgets(): array
    {
        return [
            MessagesTable::class
        ];
    }
    public static function getNavigationGroup(): ?string
    {
        return 'Management';
    }



    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTokens::route('/'),
            'view' => ViewToken::route('/{record}'),
//            'create' => Pages\CreateTokens::route('/create'),
//            'edit' => Pages\EditTokens::route('/{record}/edit'),
        ];
    }
}
