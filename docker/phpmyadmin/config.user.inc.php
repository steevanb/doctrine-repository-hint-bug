<?php

declare(strict_types=1);

const MYSQL_HOST = 'doctrine-repository-hint-bug-mysql';
const MYSQL_HIDE_DATABASES = '^(information_schema|mysql|performance_schema|sys)$';

$cfg['Servers'][1] = [
    'host' => MYSQL_HOST,
    'auth_type' => 'config',
    'user' => 'root',
    'password' => 'root',
    'hide_db' => MYSQL_HIDE_DATABASES
];

$cfg['ShowDatabasesNavigationAsTree'] = false;
