<?php

use Illuminate\Support\Facades\File;

it('has no tenant_users references in runtime code', function (): void {
    $paths = [
        app_path(),
        config_path(),
        resource_path(),
        base_path('routes/web.php'),
        base_path('routes/api.php'),
    ];

    $hasReference = false;

    foreach ($paths as $path) {
        if (is_file($path)) {
            $content = File::get($path);

            if (str_contains($content, 'tenant_users')) {
                $hasReference = true;

                break;
            }

            continue;
        }

        $files = File::allFiles($path);

        foreach ($files as $file) {
            if (str_contains(File::get($file->getPathname()), 'tenant_users')) {
                $hasReference = true;

                break 2;
            }
        }
    }

    expect($hasReference)->toBeFalse();
});
