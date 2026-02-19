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
        'tenant_settings' => [
            'navigation_label' => 'Tenantinstellingen',
            'title' => 'Tenantinstellingen',
            'password_hint' => 'Laat leeg om het huidige wachtwoord te behouden.',
            'fields' => [
                'db_host' => 'DB-host',
                'db_port' => 'DB-poort',
                'db_name' => 'DB-naam',
                'db_user' => 'DB-gebruiker',
                'db_password' => 'DB-wachtwoord',
                'db_prefix' => 'DB-prefix',
                'base_shop_url' => 'Basis shop-URL',
            ],
            'actions' => [
                'save' => 'Opslaan',
                'test_connection' => 'Verbinding testen',
                'sync_shop_url' => 'Shop-URL synchroniseren',
            ],
            'notifications' => [
                'no_tenant' => 'Tenantcontext ontbreekt.',
                'saved' => 'Instellingen opgeslagen.',
                'connection_success' => 'Verbinding gelukt.',
                'connection_failed' => 'Verbinding mislukt.',
                'sync_success' => 'Shop-URL gesynchroniseerd.',
                'sync_failed' => 'Shop-URL kon niet worden gesynchroniseerd.',
            ],
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
    'api' => [
        'products' => [
            'not_found' => 'Product niet gevonden.',
            'validation' => [
                'q' => [
                    'string' => 'Zoekterm moet een tekst zijn.',
                    'max' => 'Zoekterm mag niet langer zijn dan 255 tekens.',
                ],
                'category' => [
                    'string' => 'Categoriefilter moet een tekst zijn.',
                    'max' => 'Categoriefilter mag niet langer zijn dan 255 tekens.',
                ],
                'manufacturer' => [
                    'string' => 'Fabrikantfilter moet een tekst zijn.',
                    'max' => 'Fabrikantfilter mag niet langer zijn dan 255 tekens.',
                ],
                'min_price' => [
                    'numeric' => 'Minimumprijs moet een getal zijn.',
                    'min' => 'Minimumprijs moet minstens 0 zijn.',
                ],
                'max_price' => [
                    'numeric' => 'Maximumprijs moet een getal zijn.',
                    'gte' => 'Maximumprijs moet groter dan of gelijk aan de minimumprijs zijn.',
                ],
                'has_discount' => [
                    'boolean' => 'Kortingsfilter moet waar of onwaar zijn.',
                ],
                'page' => [
                    'integer' => 'Pagina moet een geheel getal zijn.',
                    'min' => 'Pagina moet minstens 1 zijn.',
                ],
                'per_page' => [
                    'integer' => 'Per pagina moet een geheel getal zijn.',
                    'min' => 'Per pagina moet minstens 1 zijn.',
                    'max' => 'Per pagina mag niet groter zijn dan 100.',
                ],
            ],
        ],
    ],
];
