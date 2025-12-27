<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| Force PostgreSQL to use IPv4 (NO SSL)
*/
putenv('PGHOST=' . getenv('DB_HOST'));
putenv('PGPORT=5432');
putenv('PGSSLMODE=disable');   // <-- NO SSL
putenv('PGCONNECT_TIMEOUT=10');

$active_group = 'default';
$query_builder = TRUE;

$db['default'] = array(
    'dsn'      => '',
    'hostname' => getenv('DB_HOST'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD'),
    'database' => getenv('DB_NAME'),
    'dbdriver' => 'postgre',

    'schema'   => 'public',
    'dbprefix' => '',

    'pconnect' => FALSE,
    'db_debug' => (ENVIRONMENT !== 'production'),

    'cache_on' => FALSE,
    'cachedir' => '',

    'char_set' => 'utf8',
    'dbcollat' => 'utf8_general_ci',

    'swap_pre' => '',
    'encrypt'  => FALSE,   // ✅ IMPORTANT
    'compress' => FALSE,
    'stricton' => NULL,

    'failover' => array(),
    'port'     => 5432,

    'save_queries' => TRUE
);
