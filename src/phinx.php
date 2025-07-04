<?php

# Registrando o environments do phinx com base no banco de dados

return
    [
        'paths' => [
            'migrations' => '%%PHINX_CONFIG_DIR%%/migrations',
        ],
        'environments' => [
            'default_migration_table' => 'phinxlog',
            'default_environment' => 'development',
            'development' => [
                'adapter' => 'pgsql',
                'host' => 'api-companies-postgres',
                'name' => 'api_companies',
                'user' => 'admin',
                'pass' => 'admin',
                'port' => '5432',
            ],
        ],
    ];
