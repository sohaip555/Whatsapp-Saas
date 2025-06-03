<?php

namespace App\Filament\Tenants\Resources\TokensResource\Widgets;

use App\Filament\Tenants\Resources\TokensResource;
use App\Models\messages;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Support\Str;

class MessagesTable extends BaseWidget
{

    protected int | string | array $columnSpan = 'full';

    #[\Filament\Widgets\WidgetData]
    public ?int $tokenId = null;

    public function table(Table $table): Table
    {
        return $table
            ->query(function () {
                return messages::where('token_id', $this->tokenId);
            })
            ->columns([
                Tables\Columns\TextColumn::make('message')
                    ->label('Message')
                    ->formatStateUsing(function ($state) {
                        return Str::limit($state, 60);
                    })
                    ->searchable(),

                Tables\Columns\TextColumn::make('sending_number')
                    ->label('From'),

                Tables\Columns\TextColumn::make('receiving_number')
                    ->label('To'),

                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d M Y, H:i')
                    ->sortable(),
            ]);
    }
}
