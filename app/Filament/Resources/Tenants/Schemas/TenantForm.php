<?php

namespace App\Filament\Resources\Tenants\Schemas;

use App\Models\User;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Illuminate\Database\Eloquent\Builder;

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
                Select::make('users')
                    ->relationship(
                        name: 'users',
                        titleAttribute: 'name',
                        modifyQueryUsing: fn (Builder $query): Builder => $query->orderBy('name'),
                    )
                    ->getOptionLabelFromRecordUsing(fn (User $record): string => $record->name.' ('.$record->email.')')
                    ->multiple()
                    ->searchable()
                    ->preload()
                    ->visible(fn (string $operation): bool => $operation === 'edit')
                    ->createOptionForm([
                        TextInput::make('name')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('email')
                            ->required()
                            ->email()
                            ->maxLength(255)
                            ->unique(table: User::class, column: 'email'),
                        TextInput::make('password')
                            ->required()
                            ->password()
                            ->revealable(),
                        Select::make('role')
                            ->required()
                            ->default('user')
                            ->options([
                                'admin' => 'Admin',
                                'user' => 'User',
                            ]),
                    ]),
            ])
            ->columns(2);
    }
}
