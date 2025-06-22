<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TokensResource\Pages;
use App\Filament\Resources\TokensResource\Widgets\MessagesTable;
use App\Filament\Resources\TokensResource\Widgets\TokenStats;
use App\Models\token;
use Filament\Forms\Form;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TokensResource extends Resource
{
    protected static ?string $model = Token::class;

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Tokens';

    protected static ?string $navigationGroup = 'Management';

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
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
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
            ->where('tenant_id', '=',  auth()->user()->tenant_id);
    }
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTokens::route('/'),
            'view' => Pages\ViewTokens::route('/{record}'),
//            'create' => Pages\CreateTokens::route('/create'),
//            'edit' => Pages\EditTokens::route('/{record}/edit'),
        ];
    }
}
