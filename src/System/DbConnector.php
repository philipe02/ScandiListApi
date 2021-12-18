<?php

namespace src\System;

use Src\Exceptions\GenericException;

class DbConnector
{

    private $dbConnection = null;

    public function __construct()
    {
        $host = getenv('DB_HOST');
        $port = getenv('DB_PORT');
        $db = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');

        try {
            $this->dbConnection = new \PDO(
                "mysql:host=$host;port=$port;charset=utf8mb4;dbname=$db",
                $user,
                $pass
            );
        } catch (\PDOException $e) {
            $e = new GenericException('An error ocurred, try again later!', $e->getMessage());
            header("HTTP/1.1 500 Internal Server Error");
            exit($e->getErrorMessage());
        }
    }

    public function getConnection()
    {
        return $this->dbConnection;
    }
}
