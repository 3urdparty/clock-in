<?php

return [
    /**
     * The path to the output directory.
     */
    'output_path' => base_path('src/types'),

    /**
     * The prefix for the database tables.
     */
    'database_prefix' => env('DB_PREFIX', ''),

    /**
     * Options for the models.
     */
    'models' => [
        'filename' => 'models.d.ts',
        /**
         * The path to the models directory.
         */
        // 'directory' => base_path('src/types/'),
        /**
         * The path to print PHP classes if you want to convert Models to simple classes.
         * If null will not print PHP classes.
         */
        'php_path' => null,
        /**
         * Models to skip.
         */
        'skip' => [
            // 'App\\Models\\User',
        ],
        /**
         * Whether to add the LaravelPaginate type (with API type and view type).
         */
        'paginate' => true,
        /**
         * Whether to add the fake Jetstream Team type to avoid errors.
         */
        'fake_team' => false,
    ],
    /**
     * Options for the Spatie settings.
     */
    'settings' => [
        'filename' => 'types-settings.d.ts',
        /**
         * The path to the settings directory.
         */
        'directory' => app_path('Settings'),
        /**
         * Settings to skip.
         */
        'skip' => [
            // 'App\\Settings\\Home',
        ],
    ],
    /**
     * Options for the routes.
     */
    'routes' => [
        'filename' => 'routes.d.ts',
        // 'filename_list' => 'routes.ts',
        /**
         * Use routes `path` instead of `name` for the type name.
         */
        'use_path' => false,
        /**
         * Routes to skip.
         */
        'skip' => [
            'name' => [
                '__clockwork.*',
                'debugbar.*',
                'horizon.*',
                'telescope.*',
                'nova.*',
                'lighthouse.*',
                'livewire.*',
                'ignition.*',
                'filament.*',
                'log-viewer.*',
            ],
            'path' => [
                'api/*',
            ],
        ],
    ],
];
