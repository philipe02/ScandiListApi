<?php

namespace Src\Service;

use Exception;

use Src\DTO\ProductDTO;
use \Src\Exceptions\GenericException;
use Src\Repository\ProductRepository;

class ProductService
{
    private $productsRepository;

    public function __construct()
    {
        $this->productsRepository = new ProductRepository();
    }

    public function getAllProducts()
    {
        $body = array();
        try {
            $result = $this->productsRepository->findAll();
            foreach ($result as $product) {
                array_push($body, ProductDTO::createProductDTO($product));
            }
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = json_encode($body);
            return $response;
        } catch (Exception $e) {
            $response['status_code_header'] = "HTTP/1.1 500 Internal Server Error";
            $response['body'] = $e->getMessage();
            return $response;
        }
    }

    public function createProduct($body)
    {
        try {
            $input = (array) json_decode($body, TRUE);
            $product = ProductDTO::createProductDTO($input);
            $this->productsRepository->insert($product);
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = 'Product created!';
            return $response;
        } catch (GenericException $e) {
            $response['status_code_header'] = "HTTP/1.1 500 Internal Server Error";
            if (str_contains($e::class, 'Exists'))
                $response['status_code_header'] = "HTTP/1.1 400 Bad Request";
            $response['body'] = $e->getErrorMessage();
            return $response;
        }
    }

    public function deleteProducts($productsSku)
    {
        try {
            $skuList = (array) json_decode($productsSku, TRUE);
            foreach ($skuList['sku'] as $sku) {
                $result = $this->productsRepository->find($sku);
                if (!$result) {
                    return $this->notFoundResponse();
                }

                $this->productsRepository->delete($result['sku']);
            }
            $response['status_code_header'] = 'HTTP/1.1 200 OK';
            $response['body'] = 'Product(s) deleted!';
            return $response;
        } catch (GenericException $e) {
            $response['status_code_header'] = "HTTP/1.1 500 Internal Server Error";
            if (str_contains($e::class, 'NotFound'))
                $response['status_code_header'] = "HTTP/1.1 404 Bad Request";
            $response['body'] = $e->getErrorMessage();
            return $response;
        }
    }

    private function validateProduct($input)
    {
        $product = ProductDTO::createProductDTO($input);
        if (!$product['sku'])
            return false;
        if (!$product['name'])
            return false;
        if (!$product['price'])
            return false;
        if ($product['productType'] === 1)
            if (!$product['size'])
                return false;
        if ($product['productType'] === 2) {
            if (!$product['height'])
                return false;
            if (!$product['width'])
                return false;
            if (!$product['length'])
                return false;
        }
        if ($product['productType'] === 3)
            if (!$product['weight'])
                return false;
        return $product;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
