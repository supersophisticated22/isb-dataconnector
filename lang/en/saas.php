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
];
