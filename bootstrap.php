<?php
require 'vendor/autoload.php';

use Dotenv\Dotenv;

use Src\System\DbConnector;

$dotenv = new DotEnv(__DIR__);
$dotenv->load();

// test code, should output:
// api://default
// when you run $ php bootstrap.php
$dbConnection = (new DbConnector())->getConnection();
