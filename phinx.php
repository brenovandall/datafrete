<?php

return
[
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migrations',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => 'development',
        'production' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'datafrete',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3606',
            'charset' => 'utf8',
        ],
        'development' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'datafrete',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3606',
            'charset' => 'utf8',
        ],
        'testing' => [
            'adapter' => 'mysql',
            'host' => '127.0.0.1',
            'name' => 'datafrete',
            'user' => 'root',
            'pass' => 'root',
            'port' => '3606',
            'charset' => 'utf8',
        ]
    ],
    'version_order' => 'creation'
];
