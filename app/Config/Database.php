<?php

namespace Config;

use CodeIgniter\Database\Config;

/**
 * Database Configuration
 */
class Database extends Config
{
    /**
     * The directory that holds the Migrations
     * and Seeds directories.
     */
    public string $filesPath = APPPATH . 'Database' . DIRECTORY_SEPARATOR;

    /**
     * Lets you choose which connection group to
     * use if no other is specified.
     */
    public string $defaultGroup = 'default';

    /**
     * The default database connection.
     */
    public array $default = [
        'DSN'      => '',
        'hostname' => 'localhost\SQLSERVER2022',
        'username' => 'sa',
        'password' => '',
        'database' => 'PKUSAMPANGAN_VCLAIM_V11',
        'DBDriver' => 'SQLSRV',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'UTF-8',
        'DBCollat' => 'SQL_Latin1_General_CP1_CI_AS',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433,
    ];

    public array $logdb = [
        'DSN'      => '',
        'hostname' => '192.168.10.110',
        'username' => 'sa',
        'password' => '',
        'database' => 'PKUSAMPANGAN_VCLAIM_V11',
        'DBDriver' => 'SQLSRV',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'UTF-8',
        'DBCollat' => 'SQL_Latin1_General_CP1_CI_AS',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433,
    ];
    public array $sharelis = [
        'DSN'      => '',
        'hostname' => '192.168.10.110',
        'username' => 'sa',
        'password' => '',
        'database' => 'PKUSAMPANGAN_VCLAIM_V11',
        'DBDriver' => 'SQLSRV',
        'DBPrefix' => '',
        'pConnect' => false,
        'DBDebug'  => true,
        'charset'  => 'UTF-8',
        'DBCollat' => 'SQL_Latin1_General_CP1_CI_AS',
        'swapPre'  => '',
        'encrypt'  => false,
        'compress' => false,
        'strictOn' => false,
        'failover' => [],
        'port'     => 1433,
    ];

    /**
     * This database connection is used when
     * running PHPUnit database tests.
     */
    public array $tests = [
        'DSN'         => '',
        'hostname'    => '127.0.0.1',
        'username'    => '',
        'password'    => '',
        'database'    => ':memory:',
        'DBDriver'    => 'SQLite3',
        'DBPrefix'    => 'db_',  // Needed to ensure we're working correctly with prefixes live. DO NOT REMOVE FOR CI DEVS
        'pConnect'    => false,
        'DBDebug'     => true,
        'charset'     => 'utf8',
        'DBCollat'    => 'utf8_general_ci',
        'swapPre'     => '',
        'encrypt'     => false,
        'compress'    => false,
        'strictOn'    => false,
        'failover'    => [],
        'port'        => 3306,
        'foreignKeys' => true,
        'busyTimeout' => 1000,
    ];

    public function __construct()
    {
        parent::__construct();

        // Ensure that we always set the database group to 'tests' if
        // we are currently running an automated test suite, so that
        // we don't overwrite live data on accident.
        if (ENVIRONMENT === 'testing') {
            $this->defaultGroup = 'tests';
        }
    }
}
