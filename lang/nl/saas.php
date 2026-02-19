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
        'bulk_price_update' => [
            'navigation_label' => 'Bulk prijsupdate',
            'title' => 'Bulk prijsupdate',
            'sections' => [
                'filters' => 'Filters',
                'action' => 'Actie',
            ],
            'fields' => [
                'manufacturer' => 'Fabrikant',
                'category' => 'Categorie',
                'min_price' => 'Min. prijs',
                'max_price' => 'Max. prijs',
                'has_discount' => 'Heeft korting',
                'direction' => 'Richting',
                'value_type' => 'Waarde type',
                'amount' => 'Bedrag',
            ],
            'options' => [
                'any' => 'Alle',
                'has_discount_yes' => 'Ja',
                'has_discount_no' => 'Nee',
                'increase' => 'Verhogen',
                'decrease' => 'Verlagen',
                'percent' => 'Percentage',
                'fixed' => 'Vast bedrag',
            ],
            'actions' => [
                'preview' => 'Voorbeeldtelling',
                'enqueue' => 'Update in wachtrij',
                'cancel_latest' => 'Laatste job annuleren',
            ],
            'labels' => [
                'preview_count' => 'Voorbeeldtelling',
                'latest_job' => 'Laatste job',
                'not_available' => 'N.v.t.',
            ],
            'notifications' => [
                'no_tenant' => 'Tenantcontext ontbreekt.',
                'preview_ready_title' => 'Voorbeeld klaar',
                'preview_ready_body' => ':count producten komen overeen met de geselecteerde filters.',
                'job_queued_title' => 'Bulk update in wachtrij',
                'job_queued_body' => 'Job #:job_id is in de wachtrij geplaatst.',
                'job_completed_title' => 'Bulk update voltooid (#:job_id)',
                'job_completed_body' => 'Verwerkt: :processed. Mislukt: :failed.',
                'job_failed_title' => 'Bulk update mislukt (#:job_id)',
                'job_failed_body' => 'Verwerkt: :processed. Mislukt: :failed.',
                'job_cancelled_title' => 'Bulk update geannuleerd (#:job_id)',
                'job_cancelled_body' => 'Verwerkt: :processed. Mislukt: :failed.',
                'job_cancelled_title_local' => 'Bulk update geannuleerd.',
                'no_active_job' => 'Geen actieve bulk update job gevonden.',
                'partial_failures' => 'Bulk update voltooid met :count mislukte producten.',
            ],
        ],
    ],
    'resources' => [
        'products' => [
            'navigation_label' => 'Producten',
            'model_label' => 'Product',
            'plural_model_label' => 'Producten',
            'states' => [
                'active' => 'Actief',
                'inactive' => 'Inactief',
            ],
            'table' => [
                'search_placeholder' => 'Zoek producten',
                'empty_state_heading' => 'Geen producten gevonden.',
                'actions' => [
                    'view' => 'Bekijken',
                ],
                'filters' => [
                    'active' => 'Actief',
                    'in_stock' => 'Voorraad > 0',
                    'manufacturer' => 'Fabrikant',
                ],
                'columns' => [
                    'id' => 'ID',
                    'name' => 'Naam',
                    'reference' => 'Referentie',
                    'manufacturer' => 'Fabrikant',
                    'active' => 'Actief',
                    'stock_qty' => 'Voorraad',
                    'original_price_tax_excl' => 'Oorspr. prijs (excl.)',
                    'current_price_tax_excl' => 'Huidige prijs (excl.)',
                    'original_price_tax_incl' => 'Oorspr. prijs (incl.)',
                    'current_price_tax_incl' => 'Huidige prijs (incl.)',
                ],
            ],
            'infolist' => [
                'sections' => [
                    'general' => 'Algemeen',
                    'pricing' => 'Prijzen',
                    'specific_price' => 'Specifieke prijs',
                ],
                'labels' => [
                    'formatted_price' => 'Geformatteerde prijs',
                    'specific_price' => 'Specifieke prijsstatus',
                    'discounted' => 'Afgeprijsd',
                ],
                'stock' => [
                    'in_stock' => 'op voorraad',
                    'out_of_stock' => 'niet op voorraad',
                ],
            ],
            'view' => [
                'actions' => [
                    'update_stock' => 'Voorraad bijwerken',
                    'update_base_price' => 'Basisprijs bijwerken',
                ],
                'fields' => [
                    'stock_qty' => 'Voorraadaantal',
                    'base_price_tax_excl' => 'Basisprijs (excl.)',
                ],
                'notifications' => [
                    'stock_update_success' => 'Voorraad bijgewerkt.',
                    'stock_update_failed' => 'Voorraad kon niet worden bijgewerkt.',
                    'base_price_update_success' => 'Basisprijs bijgewerkt.',
                    'base_price_update_failed' => 'Basisprijs kon niet worden bijgewerkt.',
                ],
            ],
            'relation_managers' => [
                'specific_prices' => [
                    'title' => 'Specifieke prijzen',
                    'actions' => [
                        'create' => 'Specifieke prijs toevoegen',
                        'edit' => 'Bewerken',
                        'delete' => 'Verwijderen',
                    ],
                    'columns' => [
                        'id' => 'ID',
                        'price' => 'Prijs',
                        'reduction' => 'Korting',
                        'reduction_type' => 'Kortingstype',
                        'from' => 'Van',
                        'to' => 'Tot',
                    ],
                    'fields' => [
                        'price' => 'Prijs',
                        'reduction' => 'Korting',
                        'reduction_type' => 'Kortingstype',
                        'from' => 'Van',
                        'to' => 'Tot',
                    ],
                    'reduction_types' => [
                        'amount' => 'Bedrag',
                        'percentage' => 'Percentage',
                    ],
                    'notifications' => [
                        'create_success' => 'Specifieke prijs aangemaakt.',
                        'create_failed' => 'Specifieke prijs kon niet worden aangemaakt.',
                        'update_success' => 'Specifieke prijs bijgewerkt.',
                        'update_failed' => 'Specifieke prijs kon niet worden bijgewerkt.',
                        'delete_success' => 'Specifieke prijs verwijderd.',
                        'delete_failed' => 'Specifieke prijs kon niet worden verwijderd.',
                    ],
                    'errors' => [
                        'invalid_price' => 'Specifieke prijs moet -1 of hoger zijn.',
                        'invalid_reduction' => 'Korting moet nul of hoger zijn.',
                        'invalid_reduction_type' => 'Kortingstype is ongeldig.',
                        'invalid_percentage_reduction' => 'Percentagekorting moet tussen 0 en 1 liggen.',
                        'invalid_date_range' => 'De datum "van" moet voor of gelijk zijn aan de datum "tot".',
                        'not_date_valid' => 'Specifieke prijs moet geldig zijn op de huidige datum en tijd.',
                        'not_found_or_out_of_scope' => 'Specifieke prijs niet gevonden of buiten V1-scope.',
                    ],
                ],
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
