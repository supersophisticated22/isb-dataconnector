<?php

namespace App\Services;

use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RuntimeException;

class TenantPrestaShopBlogReplyService
{
    public function __construct(
        private TenantContext $tenantContext,
        private TenantPrestaShopConnection $tenantPrestaShopConnection,
    ) {}

    /**
     * @return LengthAwarePaginator<int, object>|array<int, array<string, mixed>>
     */
    public function listReplies(int $perPage = 25): LengthAwarePaginator|array
    {
        $this->resolveTenantId();

        $replyTable = $this->tenantPrestaShopConnection->table('ets_blog_reply');
        $resolvedPerPage = max(1, $perPage);

        return DB::connection('tenant_ps')
            ->table($replyTable)
            ->orderByDesc('id_reply')
            ->paginate($resolvedPerPage);
    }

    /**
     * @return array{
     *     id_reply:int,
     *     id_comment:int,
     *     id_user:int,
     *     name:string,
     *     email:string,
     *     reply:?string,
     *     id_employee:int,
     *     approved:?int
     * }
     */
    public function getReply(int $replyId): array
    {
        $this->resolveTenantId();

        if ($replyId < 1) {
            throw new RuntimeException('Blog reply is required.');
        }

        $replyTable = $this->tenantPrestaShopConnection->table('ets_blog_reply');

        /** @var object{id_reply:int|string,id_comment:mixed,id_user:mixed,name:?string,email:?string,reply:?string,id_employee:mixed,approved:mixed}|null $row */
        $row = DB::connection('tenant_ps')
            ->table($replyTable)
            ->where('id_reply', $replyId)
            ->first();

        if ($row === null) {
            throw new RuntimeException('Blog reply not found in PrestaShop database.');
        }

        $approved = data_get($row, 'approved');

        return [
            'id_reply' => (int) data_get($row, 'id_reply', 0),
            'id_comment' => max(0, (int) data_get($row, 'id_comment', 0)),
            'id_user' => max(0, (int) data_get($row, 'id_user', 0)),
            'name' => trim((string) data_get($row, 'name', '')),
            'email' => trim((string) data_get($row, 'email', '')),
            'reply' => $this->nullableString(data_get($row, 'reply')),
            'id_employee' => max(0, (int) data_get($row, 'id_employee', 0)),
            'approved' => is_numeric($approved) ? (int) $approved : null,
        ];
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function createReply(array $payload): int
    {
        $this->resolveTenantId();

        $resolvedPayload = $this->resolvePayload($payload);
        $replyTable = $this->tenantPrestaShopConnection->table('ets_blog_reply');
        $now = now()->format('Y-m-d H:i:s');

        return (int) DB::connection('tenant_ps')
            ->table($replyTable)
            ->insertGetId([
                'id_comment' => $resolvedPayload['id_comment'],
                'id_user' => $resolvedPayload['id_user'],
                'name' => $resolvedPayload['name'],
                'email' => $resolvedPayload['email'],
                'reply' => $resolvedPayload['reply'],
                'id_employee' => $resolvedPayload['id_employee'],
                'approved' => $resolvedPayload['approved'],
                'date_add' => $now,
                'date_upd' => $now,
            ], 'id_reply');
    }

    /**
     * @param  array<string, mixed>  $payload
     */
    public function updateReply(int $replyId, array $payload): void
    {
        $this->resolveTenantId();

        if ($replyId < 1) {
            throw new RuntimeException('Blog reply is required.');
        }

        $resolvedPayload = $this->resolvePayload($payload);
        $replyTable = $this->tenantPrestaShopConnection->table('ets_blog_reply');
        $now = now()->format('Y-m-d H:i:s');

        $updated = DB::connection('tenant_ps')
            ->table($replyTable)
            ->where('id_reply', $replyId)
            ->update([
                'id_comment' => $resolvedPayload['id_comment'],
                'id_user' => $resolvedPayload['id_user'],
                'name' => $resolvedPayload['name'],
                'email' => $resolvedPayload['email'],
                'reply' => $resolvedPayload['reply'],
                'id_employee' => $resolvedPayload['id_employee'],
                'approved' => $resolvedPayload['approved'],
                'date_upd' => $now,
            ]);

        if ($updated < 1) {
            throw new RuntimeException('Blog reply not found in PrestaShop database.');
        }
    }

    public function deleteReply(int $replyId): void
    {
        $this->resolveTenantId();

        if ($replyId < 1) {
            throw new RuntimeException('Blog reply is required.');
        }

        $replyTable = $this->tenantPrestaShopConnection->table('ets_blog_reply');

        $deleted = DB::connection('tenant_ps')
            ->table($replyTable)
            ->where('id_reply', $replyId)
            ->delete();

        if ($deleted < 1) {
            throw new RuntimeException('Blog reply not found in PrestaShop database.');
        }
    }

    private function resolveTenantId(): int
    {
        $tenantId = $this->tenantContext->tenantId();

        if (! is_int($tenantId) || $tenantId < 1) {
            throw new RuntimeException('Tenant context is missing.');
        }

        return $tenantId;
    }

    /**
     * @param  array<string, mixed>  $payload
     * @return array{
     *     id_comment:int,
     *     id_user:int,
     *     name:string,
     *     email:string,
     *     reply:?string,
     *     id_employee:int,
     *     approved:?int
     * }
     */
    private function resolvePayload(array $payload): array
    {
        $idComment = max(0, (int) ($payload['id_comment'] ?? 0));

        if ($idComment < 1) {
            throw new RuntimeException('Reply comment id is required.');
        }

        $name = trim((string) ($payload['name'] ?? ''));
        $email = trim((string) ($payload['email'] ?? ''));

        if ($name === '' || $email === '') {
            throw new RuntimeException('Reply name and email are required.');
        }

        $approved = $payload['approved'] ?? null;

        $resolvedEmployeeId = max(0, (int) ($payload['id_employee'] ?? 0));
        $tenantUserId = Auth::guard('tenant')->id();
        $webUserId = Auth::guard('web')->id();

        if ($resolvedEmployeeId < 1 && is_numeric($tenantUserId)) {
            $resolvedEmployeeId = max(0, (int) $tenantUserId);
        }

        if ($resolvedEmployeeId < 1 && is_numeric($webUserId)) {
            $resolvedEmployeeId = max(0, (int) $webUserId);
        }

        return [
            'id_comment' => $idComment,
            'id_user' => max(0, (int) ($payload['id_user'] ?? 0)),
            'name' => $name,
            'email' => $email,
            'reply' => $this->nullableString($payload['reply'] ?? null),
            'id_employee' => $resolvedEmployeeId,
            'approved' => is_numeric($approved) ? (int) $approved : null,
        ];
    }

    private function nullableString(mixed $value): ?string
    {
        if (! is_scalar($value) && $value !== null) {
            return null;
        }

        $resolvedValue = trim((string) $value);

        return $resolvedValue !== '' ? $resolvedValue : null;
    }
}
