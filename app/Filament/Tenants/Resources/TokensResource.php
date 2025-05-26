<?php

namespace App\Filament\Tenants\Resources;

use App\Filament\Tenants\Resources\TokensResource\Pages;
use App\Filament\Tenants\Resources\TokensResource\RelationManagers;
use App\Models\token;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Forms;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
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

    protected static ?string $navigationIcon = 'heroicon-o-key';

    protected static ?string $navigationLabel = 'Tokens';
    protected static ?string $pluralModelLabel = 'Tokens';

    public static function form(Form $form): Form
    {
        return $form
            ->schema(token::getForm($form));
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('tenantSubscriptionLog.name'),
                TextColumn::make('token')->searchable()
                    ->formatStateUsing(function ($state) {
                        return Str::limit($state, 20);
                    }),
                TextColumn::make('message_quota'),
                Tables\Columns\ToggleColumn::make('isActive')
                    ->label('Active')
                    ->default(function ($status) {
                        return $status ? 'Active' : 'Inactive';
                    }),
                TextColumn::make('created_at')->dateTime(),
            ])
            ->filters([
                //
            ])
            ->actions([
//                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
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

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTokens::route('/'),
//            'create' => Pages\CreateTokens::route('/create'),
//            'edit' => Pages\EditTokens::route('/{record}/edit'),
        ];
    }
}
