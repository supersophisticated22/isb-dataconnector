<?php

namespace App\Filament\Resources\ApiTokens\Schemas;

use App\Models\Tenant;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

class ApiTokenForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('tenant_id')
                    ->label('Tenant')
                    ->relationship(
                        name: 'tenant',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query): Builder => $query->orderBy('name'),
                    )
                    ->getOptionLabelFromRecordUsing(fn (Tenant $record): string => $record->name.' ('.$record->slug.')')
                    ->required()
                    ->searchable()
                    ->preload(),
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TagsInput::make('abilities')
                    ->default(['*'])
                    ->separator(',')
                    ->required(),
            ])
            ->columns(2);
    }
}
