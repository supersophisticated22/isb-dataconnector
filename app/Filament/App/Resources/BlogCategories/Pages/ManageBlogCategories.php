<?php

namespace App\Filament\App\Resources\BlogCategories\Pages;

use App\Filament\App\Resources\BlogCategories\BlogCategoryResource;
use App\Services\TenantPrestaShopBlogCategoryService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class ManageBlogCategories extends ManageRecords
{
    protected static string $resource = BlogCategoryResource::class;

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
            ->where('c.id_category', (int) $key)
            ->first();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createBlogCategory')
                ->label(__('saas.resources.blog_categories.table.actions.create'))
                ->icon('heroicon-o-plus')
                ->form(BlogCategoryResource::blogCategoryFormSchema())
                ->action(function (array $data): void {
                    try {
                        app(TenantPrestaShopBlogCategoryService::class)->createCategory($data);

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.blog_categories.notifications.create_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.blog_categories.notifications.create_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }
}
