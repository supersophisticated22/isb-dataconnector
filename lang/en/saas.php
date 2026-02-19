<?php

return [
    'panel' => [
        'brand' => 'SaaS',
    ],
    'pages' => [
        'dashboard' => [
            'navigation_label' => 'Dashboard',
            'title' => 'SaaS Dashboard',
        ],
    ],
    'seeders' => [
        'tenant_created' => 'Tenant created: :name',
        'user_created' => 'Tenant user created: :email (:role)',
        'api_token_plaintext' => 'Plaintext API token for ":name" (displayed once): :token',
        'api_token_stored_hash' => 'Stored hashed API token record ID: :id',
    ],
    'auth' => [
        'missing_tenant_token' => 'Tenant token is required.',
        'invalid_tenant_token' => 'The tenant token is invalid.',
    ],
    'typesense' => [
        'reindex' => [
            'started' => 'TypeSense tenant product reindex started for tenant :tenant_id.',
            'completed' => 'TypeSense tenant product reindex completed for tenant :tenant_id.',
            'failed' => 'TypeSense tenant product reindex failed for tenant :tenant_id. Error: :message',
        ],
    ],
];
