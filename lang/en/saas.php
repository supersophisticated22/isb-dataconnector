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
    'api' => [
        'products' => [
            'not_found' => 'Product not found.',
            'validation' => [
                'q' => [
                    'string' => 'Search query must be a string.',
                    'max' => 'Search query may not be greater than 255 characters.',
                ],
                'category' => [
                    'string' => 'Category filter must be a string.',
                    'max' => 'Category filter may not be greater than 255 characters.',
                ],
                'manufacturer' => [
                    'string' => 'Manufacturer filter must be a string.',
                    'max' => 'Manufacturer filter may not be greater than 255 characters.',
                ],
                'min_price' => [
                    'numeric' => 'Minimum price must be a number.',
                    'min' => 'Minimum price must be at least 0.',
                ],
                'max_price' => [
                    'numeric' => 'Maximum price must be a number.',
                    'gte' => 'Maximum price must be greater than or equal to minimum price.',
                ],
                'has_discount' => [
                    'boolean' => 'Discount filter must be true or false.',
                ],
                'page' => [
                    'integer' => 'Page must be an integer.',
                    'min' => 'Page must be at least 1.',
                ],
                'per_page' => [
                    'integer' => 'Per-page must be an integer.',
                    'min' => 'Per-page must be at least 1.',
                    'max' => 'Per-page may not be greater than 100.',
                ],
            ],
        ],
    ],
];
