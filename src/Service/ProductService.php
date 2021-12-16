<?php

namespace Src\Service;

use Exception;

use Src\DTO\ProductDTO;
use Src\Exceptions\DuplicateEntryException;
use Src\Exceptions\GenericException;
use Src\Model\Book;
use Src\Model\Dvd;
use Src\Model\Furniture;
use Src\Repository\ProductRepository;

class ProductService
{
    private $productsRepository;

    public function __construct()
    {
        $this->productsRepository = new ProductRepository;
    }

    public function getAllProducts()
    {
        $body = array();
        $result = $this->productsRepository->findAll();
        foreach ($result as $product) {
            array_push($body, ProductDTO::createProductDTO($product));
        }
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($body);
        return $response;
    }

    public function createProduct($body)
    {
        $input = (array) json_decode($body, TRUE);
        $product = ProductDTO::createProductDTO($input);
        try {
            $this->productsRepository->insert($product);
            $response['status_code_header'] = 'HTTP/1.1 201 Created';
            $response['body'] = 'Product created!';
            return $response;
        } catch (Exception $e) {
            if (str_contains($e->getMessage(), 'exists')) {
                $response['status_code_header'] = "HTTP/1.1 400 Bad Request";
                $response['body'] = $e->getMessage();
                return $response;
            }
            $response['status_code_header'] = "HTTP/1.1 500 Internal Server Error";
            $response['body'] = $e->getMessage();
            return $response;
        }
    }

    public function deleteProducts($productsSku)
    {
        foreach ($productsSku as $sku) {
            $result = $this->productsRepository->find($sku);
            if (!$result) {
                return $this->notFoundResponse();
            }
            $this->productsRepository->delete($sku);
        }
        $response['status_code_header'] = http_response_code(200);
        $response['body'] = 'Product(s) deleted!';
        return $response;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
