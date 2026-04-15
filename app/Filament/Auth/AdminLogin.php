<?php

namespace App\Filament\Auth;

use DanHarrin\LivewireRateLimiting\Exceptions\TooManyRequestsException;
use Filament\Auth\Http\Responses\Contracts\LoginResponse;
use Filament\Auth\MultiFactor\Contracts\HasBeforeChallengeHook;
use Filament\Auth\Pages\Login;
use Filament\Facades\Filament;
use Filament\Models\Contracts\FilamentUser;
use Illuminate\Auth\SessionGuard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class AdminLogin extends Login
{
    public function authenticate(): ?LoginResponse
    {
        try {
            $this->rateLimit(5);
        } catch (TooManyRequestsException $exception) {
            $this->getRateLimitedNotification($exception)?->send();

            return null;
        }

        $data = $this->form->getState();

        /** @var SessionGuard $authGuard */
        $authGuard = Filament::auth();

        $authProvider = $authGuard->getProvider();
        $credentials = $this->getCredentialsFromFormData($data);

        $user = $authProvider->retrieveByCredentials($credentials);

        if ((! $user) || (! $authProvider->validateCredentials($user, $credentials))) {
            $this->userUndertakingMultiFactorAuthentication = null;

            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        if (
            filled($this->userUndertakingMultiFactorAuthentication) &&
            (decrypt($this->userUndertakingMultiFactorAuthentication) === $user->getAuthIdentifier())
        ) {
            if ($this->isMultiFactorChallengeRateLimited($user)) {
                return null;
            }

            $this->multiFactorChallengeForm->validate();
        } else {
            foreach (Filament::getMultiFactorAuthenticationProviders() as $multiFactorAuthenticationProvider) {
                if (! $multiFactorAuthenticationProvider->isEnabled($user)) {
                    continue;
                }

                $this->userUndertakingMultiFactorAuthentication = encrypt($user->getAuthIdentifier());

                if ($multiFactorAuthenticationProvider instanceof HasBeforeChallengeHook) {
                    $multiFactorAuthenticationProvider->beforeChallenge($user);
                }

                break;
            }

            if (filled($this->userUndertakingMultiFactorAuthentication)) {
                $this->multiFactorChallengeForm->fill();

                return null;
            }
        }

        if (! $authGuard->attemptWhen($credentials, fn (Authenticatable $user): bool => $this->canAccessAdminOrAppPanel($user), $data['remember'] ?? false)) {
            $this->fireFailedEvent($authGuard, $user, $credentials);
            $this->throwFailureValidationException();
        }

        session()->regenerate();

        $this->setTenantGuardAndIntendedUrlWhenNeeded($authGuard->user(), (bool) ($data['remember'] ?? false));

        return app(LoginResponse::class);
    }

    protected function canAccessAdminOrAppPanel(Authenticatable $user): bool
    {
        if (! $user instanceof FilamentUser) {
            return true;
        }

        $currentPanel = Filament::getCurrentOrDefaultPanel();

        if ($user->canAccessPanel($currentPanel)) {
            return true;
        }

        $appPanel = Filament::getPanel('app');

        return $user->canAccessPanel($appPanel);
    }

    protected function setTenantGuardAndIntendedUrlWhenNeeded(?Authenticatable $user, bool $remember): void
    {
        if (! $user instanceof FilamentUser) {
            return;
        }

        $currentPanel = Filament::getCurrentOrDefaultPanel();

        if ($user->canAccessPanel($currentPanel)) {
            return;
        }

        $appPanel = Filament::getPanel('app');

        if (! $user->canAccessPanel($appPanel)) {
            return;
        }

        Auth::guard('tenant')->login($user, $remember);
        Auth::shouldUse('tenant');

        $intendedUrl = Route::has('filament.app.tenant')
            ? route('filament.app.tenant')
            : $appPanel->getUrl();

        if (filled($intendedUrl)) {
            session()->put('url.intended', $intendedUrl);
        }
    }
}
