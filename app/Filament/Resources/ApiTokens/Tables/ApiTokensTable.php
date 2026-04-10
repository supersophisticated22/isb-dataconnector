<?php

namespace App\Filament\Resources\ApiTokens\Tables;

use Filament\Actions\DeleteAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ApiTokensTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('id')
                    ->sortable(),
                TextColumn::make('tenant.name')
                    ->label('Tenant')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('abilities')
                    ->formatStateUsing(function (mixed $state): string {
                        if (! is_array($state)) {
                            return '';
                        }

                        return implode(', ', $state);
                    })
                    ->toggleable(),
                TextColumn::make('last_used_at')
                    ->dateTime()
                    ->sortable(),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable(),
            ])
            ->recordActions([
                DeleteAction::make(),
            ]);
    }
}
