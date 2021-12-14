<?php

namespace Src\Repository;

use src\System\DbConnector;

class ProductRepository
{
    private $db;

    public function __construct()
    {
        $this->db = (new DbConnector())->getConnection();
    }
    public function findAll()
    {
        $statement = "SELECT * FROM products";
        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function find($sku)
    {
        $statement = "SELECT * FROM products WHERE id = ?";
        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function insert($product)
    {
        $statement = "SELECT * FROM products";
        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
    public function delete($sku)
    {
        $statement = "SELECT * FROM products";
        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            exit($e->getMessage());
        }
    }
}
