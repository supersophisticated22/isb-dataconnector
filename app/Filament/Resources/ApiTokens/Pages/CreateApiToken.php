<?php

namespace App\Filament\Resources\ApiTokens\Pages;

use App\Filament\Resources\ApiTokens\ApiTokenResource;
use App\Models\ApiToken;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateApiToken extends CreateRecord
{
    protected static string $resource = ApiTokenResource::class;

    protected static bool $canCreateAnother = false;

    public ?string $generatedPlainTextToken = null;

    /**
     * @param  array{tenant_id:int|string,name:string,abilities?:array<int, string>}  $data
     */
    protected function handleRecordCreation(array $data): Model
    {
        $tenantId = (int) $data['tenant_id'];
        $name = (string) $data['name'];
        $abilities = $this->normalizeAbilities($data['abilities'] ?? ['*']);

        [$token, $plainTextToken] = ApiToken::issue($tenantId, $name, $abilities);

        $this->generatedPlainTextToken = $plainTextToken;

        return $token;
    }

    protected function getCreatedNotification(): ?Notification
    {
        $tokenValue = $this->generatedPlainTextToken ?? '';

        return Notification::make()
            ->success()
            ->title('API token created')
            ->body('Copy this token now, it will only be shown once: '.$tokenValue);
    }

    /**
     * @return array<int, string>
     */
    private function normalizeAbilities(mixed $abilities): array
    {
        if (is_string($abilities)) {
            $abilities = explode(',', $abilities);
        }

        if (! is_array($abilities)) {
            return ['*'];
        }

        $normalized = array_values(array_filter(
            array_map(static fn (mixed $ability): string => trim((string) $ability), $abilities),
            static fn (string $ability): bool => $ability !== '',
        ));

        return $normalized !== [] ? $normalized : ['*'];
    }
}
