<?php

namespace App\Filament\Resources\SubscriptionsResource\Widgets;

use App\Models\token;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class TokensTable extends BaseWidget
{

    public function getColumnSpan(): int
    {
        return 2;
    }


    public function table(Table $table): Table
    {
        return $table
            ->query(function (Builder $query) {
                return token::where('message_quota', '>' , '0');
            }
            )
            ->columns(
                [
                    TextColumn::make('token')->searchable()
                        ->formatStateUsing(function ($state) {
                            return Str::limit($state, 20);
                        }),
                    TextColumn::make('message_quota'),
                    ToggleColumn::make('isActive')
                        ->label('Active')
                        ->default(function ($status) {
                            return $status ? 'Active' : 'Inactive';
                        }),
                    TextColumn::make('created_at')->dateTime(),
                ]
            )
            ->filters([
                Tables\Filters\Filter::make('isActive')
                    ->label('Show Only the Token is Active')
                    ->query(function ($query) {
                        $query->where('isActive', 1);
                    }),
            ]);
    }
}
