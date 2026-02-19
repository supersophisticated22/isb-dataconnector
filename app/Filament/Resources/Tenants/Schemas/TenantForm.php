<?php

namespace App\Filament\Resources\Tenants\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class TenantForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('slug')
                    ->required()
                    ->maxLength(255)
                    ->unique(ignoreRecord: true),
                TextInput::make('db_host')
                    ->required()
                    ->maxLength(255),
                TextInput::make('db_port')
                    ->required()
                    ->integer()
                    ->minValue(1)
                    ->maxValue(65535),
                TextInput::make('db_name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('db_user')
                    ->required()
                    ->maxLength(255),
                TextInput::make('db_password')
                    ->password()
                    ->revealable()
                    ->dehydrated(fn (mixed $state): bool => filled($state))
                    ->required(fn (string $operation): bool => $operation === 'create'),
                TextInput::make('db_prefix')
                    ->required()
                    ->maxLength(255),
                TextInput::make('base_shop_url')
                    ->required()
                    ->url()
                    ->maxLength(255),
                Select::make('status')
                    ->required()
                    ->options([
                        'active' => 'Active',
                        'inactive' => 'Inactive',
                    ]),
            ])
            ->columns(2);
    }
}
