<?php

namespace App\Filament\Tenants\Resources;

use App\Filament\Tenants\Resources\MessagesResource\Pages;
use App\Filament\Tenants\Widgets\DashboardStats;
use App\Models\Messages;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class MessagesResource extends Resource
{
    protected static ?string $model = Messages::class;

    protected static ?int $sort = 3;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Messaging';
    protected static ?string $navigationLabel = 'Messages';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->formatStateUsing(function ($state) {
                        return Str::limit($state, 20);
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('sending_number')
                    ->label('From'),

                Tables\Columns\TextColumn::make('receiving_number')
                    ->label('To'),

                Tables\Columns\TextColumn::make('token.token')
                    ->label('Token')
                    ->formatStateUsing(function ($state) {
                        return Str::limit($state, 20);
                    })
                    ->sortable(),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
//                    Tables\Actions\EditAction::make(),
//                    Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([

            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getWidgets(): array
    {
        return [
            DashboardStats::class,
        ];
    }


    public static function getNavigationIcon(): string
    {
        return 'heroicon-o-chat-bubble-left-right';
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListMessages::route('/'),
//            'create' => Pages\CreateMessages::route('/create'),
//            'edit' => Pages\EditMessages::route('/{record}/edit'),
        ];
    }
}
