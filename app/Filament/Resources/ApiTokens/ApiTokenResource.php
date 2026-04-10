<?php

namespace App\Filament\Resources\ApiTokens;

use App\Filament\Resources\ApiTokens\Pages\CreateApiToken;
use App\Filament\Resources\ApiTokens\Pages\ListApiTokens;
use App\Filament\Resources\ApiTokens\Schemas\ApiTokenForm;
use App\Filament\Resources\ApiTokens\Tables\ApiTokensTable;
use App\Models\ApiToken;
use BackedEnum;
use Filament\Resources\Pages\PageRegistration;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Gate;

class ApiTokenResource extends Resource
{
    protected static ?string $model = ApiToken::class;

    protected static string|BackedEnum|null $navigationIcon = 'heroicon-o-key';

    protected static ?int $navigationSort = 30;

    public static function form(Schema $schema): Schema
    {
        return ApiTokenForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ApiTokensTable::configure($table);
    }

    /**
     * @return array<string, PageRegistration>
     */
    public static function getPages(): array
    {
        return [
            'index' => ListApiTokens::route('/'),
            'create' => CreateApiToken::route('/create'),
        ];
    }

    public static function canViewAny(): bool
    {
        return Gate::allows('access-admin-panel');
    }

    public static function canCreate(): bool
    {
        return Gate::allows('access-admin-panel');
    }

    public static function canDelete(mixed $record): bool
    {
        return Gate::allows('access-admin-panel');
    }
}
