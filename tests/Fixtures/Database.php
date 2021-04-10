<?php

return [
    'PostgreSQL' => [
        'developer' => 'Michael Stonebraker',
        'database' => [
            'system' => 'postgres',
            'embedded' => 0,
            'license' => 'PostgreSQL License',
        ],
        'website' => [
            'address' => 'postgresql.org',
        ],
        'tools' => ['psql', 'pg_dump']
    ],
    'MariaDB' => [
        'developer' => 'Michael Widenius',
        'database' => [
            'system' => 'mariadb',
            'embedded' => 0,
            'license' => 'GPLv2',
        ],
        'website' => [
            'address' => 'mariadb.org',
        ],
        'tools' => [
            0 => 'mysql',
            1 => 'mysqldump'
        ]
    ],
    'SQLite' => [
        'developer' => 'Dwayne Richard Hipp',
        'database' => [
            'system' => 'sqlite',
            'embedded' => 1,
            'license' => 'Public domain',
        ],
        'website' => [
            'address' => 'sqlite.org',
        ],
    ]
];
