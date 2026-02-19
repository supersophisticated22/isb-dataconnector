<?php

return [
    'panel' => [
        'brand' => 'SaaS',
    ],
    'pages' => [
        'dashboard' => [
            'navigation_label' => 'Dashboard',
            'title' => 'SaaS-dashboard',
        ],
    ],
    'seeders' => [
        'tenant_created' => 'Tenant aangemaakt: :name',
        'user_created' => 'Tenant-gebruiker aangemaakt: :email (:role)',
        'api_token_plaintext' => 'Platte API-token voor ":name" (eenmalig getoond): :token',
        'api_token_stored_hash' => 'Opgeslagen gehashte API-token record-ID: :id',
    ],
    'auth' => [
        'missing_tenant_token' => 'Tenant-token is verplicht.',
        'invalid_tenant_token' => 'De tenant-token is ongeldig.',
    ],
    'typesense' => [
        'reindex' => [
            'started' => 'TypeSense tenant product-herindexering gestart voor tenant :tenant_id.',
            'completed' => 'TypeSense tenant product-herindexering voltooid voor tenant :tenant_id.',
            'failed' => 'TypeSense tenant product-herindexering mislukt voor tenant :tenant_id. Fout: :message',
        ],
    ],
];
