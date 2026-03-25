<?php

namespace App\Filament\App\Resources\CmsCategories\Pages;

use App\Filament\App\Resources\CmsCategories\CmsCategoryResource;
use App\Services\TenantPrestaShopCmsCategoryService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class ManageCmsCategories extends ManageRecords
{
    protected static string $resource = CmsCategoryResource::class;

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
            ->where('c.id_cms_category', (int) $key)
            ->first();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createCmsCategory')
                ->label(__('saas.resources.cms_categories.table.actions.create'))
                ->icon('heroicon-o-plus')
                ->form(CmsCategoryResource::cmsCategoryFormSchema())
                ->action(function (array $data): void {
                    try {
                        app(TenantPrestaShopCmsCategoryService::class)->createCategory(
                            langId: (int) ($data['id_lang'] ?? 0),
                            payload: $data,
                        );

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.cms_categories.notifications.create_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.cms_categories.notifications.create_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }
}
