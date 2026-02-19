<?php

use App\Models\Tenant;
use Illuminate\Foundation\Testing\RefreshDatabase;

uses(RefreshDatabase::class);

it('encrypts tenant database passwords at rest', function () {
    $tenant = Tenant::factory()->create([
        'db_password' => 'secret-password',
    ]);

    expect($tenant->getRawOriginal('db_password'))->not->toBe('secret-password');
    expect($tenant->fresh()?->db_password)->toBe('secret-password');
});

it('keeps existing password when it is not replaced', function () {
    $tenant = Tenant::factory()->create([
        'db_password' => 'initial-password',
        'db_host' => '127.0.0.1',
    ]);

    $tenant->update([
        'db_host' => 'localhost',
    ]);

    expect($tenant->fresh()?->db_password)->toBe('initial-password');
});
