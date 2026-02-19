<x-filament-panels::page>
    <div class="space-y-6">
        {{ $this->form }}

        <div class="flex flex-wrap items-center gap-3">
            <x-filament::button wire:click="preview">
                {{ __('saas.pages.bulk_price_update.actions.preview') }}
            </x-filament::button>

            <x-filament::button wire:click="enqueue" color="success">
                {{ __('saas.pages.bulk_price_update.actions.enqueue') }}
            </x-filament::button>

            <x-filament::button wire:click="cancelLatestJob" color="gray">
                {{ __('saas.pages.bulk_price_update.actions.cancel_latest') }}
            </x-filament::button>
        </div>

        <div class="rounded-xl border border-gray-200 p-4 text-sm dark:border-gray-700">
            <p>
                <strong>{{ __('saas.pages.bulk_price_update.labels.preview_count') }}:</strong>
                {{ $this->previewCount ?? __('saas.pages.bulk_price_update.labels.not_available') }}
            </p>

            <p class="mt-2">
                <strong>{{ __('saas.pages.bulk_price_update.labels.latest_job') }}:</strong>
                @if ($this->latestJob)
                    #{{ $this->latestJob->id }} - {{ $this->latestJob->status }}
                    ({{ (int) $this->latestJob->progress_current }}/{{ (int) $this->latestJob->progress_total }})
                @else
                    {{ __('saas.pages.bulk_price_update.labels.not_available') }}
                @endif
            </p>
        </div>
    </div>
</x-filament-panels::page>
