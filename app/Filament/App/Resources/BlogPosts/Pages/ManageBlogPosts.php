<?php

namespace App\Filament\App\Resources\BlogPosts\Pages;

use App\Filament\App\Resources\BlogPosts\BlogPostResource;
use App\Services\TenantPrestaShopBlogPostService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class ManageBlogPosts extends ManageRecords
{
    protected static string $resource = BlogPostResource::class;

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
            ->where('p.id_post', (int) $key)
            ->first();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createBlogPost')
                ->label(__('saas.resources.blog_posts.table.actions.create'))
                ->icon('heroicon-o-plus')
                ->form(BlogPostResource::blogPostFormSchema())
                ->action(function (array $data): void {
                    try {
                        app(TenantPrestaShopBlogPostService::class)->createPost($data);

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.blog_posts.notifications.create_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.blog_posts.notifications.create_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }
}
