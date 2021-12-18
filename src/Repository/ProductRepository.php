<?php

namespace Src\Repository;

use Exception;
use \Src\Exceptions\GenericException;
use \Src\Exceptions\ProductAlreadyExistsException;
use \Src\Exceptions\ProductNotFoundException;
use Src\System\DbConnector;

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
            throw new GenericException('An error ocurred, try again later!', $e->getMessage());
        }
    }
    public function find($sku)
    {
        $statement = "SELECT * FROM products WHERE sku = ?";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array($sku));
            $result = $statement->fetch(\PDO::FETCH_UNIQUE);
            if (!$result)
                throw new ProductNotFoundException("Produduct {$sku} not found");
            return $result;
        } catch (\PDOException $e) {
            throw new GenericException('An error ocurred, try again later!', $e->getMessage());
        }
    }
    public function insert($product)
    {
        $statement = "INSERT INTO products 
        (sku, product_type, name, price, size, weight, height, length, width) 
        VALUES 
        (:sku, :product_type, :name, :price, :size, :weight, :height, :length, :width);";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array(
                'sku' => $product['sku'],
                'product_type' => $product['productType'],
                'name' => $product['name'],
                'price' => $product['price'],
                'size' => isset($product['size']) ? $product['size'] : null,
                'weight' => isset($product['weight']) ? $product['weight'] : null,
                'height' => isset($product['height']) ? $product['height'] : null,
                'length' => isset($product['length']) ? $product['length'] : null,
                'width' => isset($product['width']) ? $product['width'] : null
            ));
            $result = $statement->rowCount();
            return $result;
        } catch (\PDOException $e) {
            if (str_contains($e->getMessage(), 'Duplicate'))
                throw new ProductAlreadyExistsException($e->getMessage());
            throw new GenericException('An error ocurred!', $e->getMessage());
        }
    }
    public function delete($sku)
    {
        $statement = "DELETE FROM products WHERE sku = :sku";
        try {
            $statement = $this->db->prepare($statement);
            $statement->execute(array('sku' => $sku));
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            throw new GenericException('An error ocurred, try again later!', $e->getMessage());
        }
    }
}
