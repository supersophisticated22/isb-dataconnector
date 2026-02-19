<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends Factory<\App\Models\Tenant>
 */
class TenantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->company();

        return [
            'name' => $name,
            'slug' => Str::slug($name).'-'.fake()->unique()->numberBetween(1000, 9999),
            'db_host' => '127.0.0.1',
            'db_port' => 3306,
            'db_name' => 'prestashop_'.fake()->unique()->word(),
            'db_user' => fake()->userName(),
            'db_password' => fake()->password(),
            'db_prefix' => 'ps_',
            'base_shop_url' => 'https://'.Str::slug($name).'.example.test',
            'status' => 'active',
        ];
    }
}
