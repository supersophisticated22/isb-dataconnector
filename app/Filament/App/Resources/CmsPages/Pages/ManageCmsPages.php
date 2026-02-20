<?php

namespace App\Filament\App\Resources\CmsPages\Pages;

use App\Filament\App\Resources\CmsPages\CmsPageResource;
use App\Services\TenantPrestaShopCmsPageService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class ManageCmsPages extends ManageRecords
{
    protected static string $resource = CmsPageResource::class;

    /**
     * @return Model|array<string, mixed>|null
     */
    protected function resolveTableRecord(?string $key): Model|array|null
    {
        if ($key === null) {
            return null;
        }

        $query = $this->applyFiltersToTableQuery(
            $this->getTable()->getQuery(isResolvingRecord: true),
            isResolvingRecord: true,
        );

        foreach ($this->getTable()->getVisibleColumns() as $column) {
            $column->applyRelationshipAggregates($query);
        }

        return $query
            ->where('c.id_cms', (int) $key)
            ->first();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createCmsPage')
                ->label(__('saas.resources.cms_pages.table.actions.create'))
                ->icon('heroicon-o-plus')
                ->form(CmsPageResource::cmsFormSchema())
                ->action(function (array $data): void {
                    try {
                        app(TenantPrestaShopCmsPageService::class)->upsertPage(
                            langId: (int) ($data['id_lang'] ?? 0),
                            payload: $data,
                        );

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.cms_pages.notifications.create_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.cms_pages.notifications.create_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }
}
