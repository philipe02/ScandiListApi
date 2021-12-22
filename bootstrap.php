<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

use Src\System\DbConnector;

if (file_exists(__DIR__ . '/.env')) {
    $dotenv = new DotEnv(__DIR__);
    $dotenv->load();
}

// test code, should output:
// api://default
// when you run $ php bootstrap.php
$dbConnection = (new DbConnector())->getConnection();
