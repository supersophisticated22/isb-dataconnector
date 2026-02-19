<?php

namespace Database\Seeders;

use App\Models\ApiToken;
use App\Models\Tenant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $tenant = Tenant::query()->create([
            'name' => 'Acme Demo',
            'slug' => 'acme-demo',
            'db_host' => '127.0.0.1',
            'db_port' => 3306,
            'db_name' => 'prestashop_demo',
            'db_user' => 'prestashop_user',
            'db_password' => 'secret-password',
            'db_prefix' => 'ps_',
            'base_shop_url' => 'https://shop.example.test',
            'status' => 'active',
        ]);

        $user = User::query()->create([
            'tenant_id' => $tenant->id,
            'name' => 'Admin User',
            'email' => 'admin@example.test',
            'password' => 'password',
            'role' => 'admin',
        ]);

        [$token, $plainTextToken] = ApiToken::issue($tenant->id, 'Bootstrap API Token', ['*']);

        if ($this->command === null) {
            return;
        }

        $this->command->info(trans('saas.seeders.tenant_created', ['name' => $tenant->name]));
        $this->command->info(trans('saas.seeders.user_created', ['email' => $user->email, 'role' => $user->role]));
        $this->command->warn(trans('saas.seeders.api_token_plaintext', [
            'name' => $token->name,
            'token' => $plainTextToken,
        ]));
        $this->command->line(trans('saas.seeders.api_token_stored_hash', ['id' => $token->id]));
    }
}
