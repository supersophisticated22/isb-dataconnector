<?php

namespace App\Filament\App\Resources\BlogReplies\Pages;

use App\Filament\App\Resources\BlogReplies\BlogReplyResource;
use App\Services\TenantPrestaShopBlogReplyService;
use Filament\Actions\Action;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Database\Eloquent\Model;
use RuntimeException;

class ManageBlogReplies extends ManageRecords
{
    protected static string $resource = BlogReplyResource::class;

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
            ->where('r.id_reply', (int) $key)
            ->first();
    }

    protected function getHeaderActions(): array
    {
        return [
            Action::make('createBlogReply')
                ->label(__('saas.resources.blog_replies.table.actions.create'))
                ->icon('heroicon-o-plus')
                ->form(BlogReplyResource::blogReplyFormSchema())
                ->action(function (array $data): void {
                    try {
                        app(TenantPrestaShopBlogReplyService::class)->createReply($data);

                        Notification::make()
                            ->success()
                            ->title(__('saas.resources.blog_replies.notifications.create_success'))
                            ->send();
                    } catch (RuntimeException $exception) {
                        Notification::make()
                            ->danger()
                            ->title(__('saas.resources.blog_replies.notifications.create_failed'))
                            ->body($exception->getMessage())
                            ->send();
                    }
                }),
        ];
    }
}
