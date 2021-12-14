<?php

namespace Src\Service;

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
        $result = $this->productsRepository->findAll();
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($result);
        return $response;
    }

    public function createProduct()
    {
        $input = (array) json_decode(file_get_contents('php://input'), TRUE);
        $this->productsRepository->insert($input);
        $response['status_code_header'] = 'HTTP/1.1 201 Created';
        $response['body'] = null;
        return $response;
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
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = null;
        return $response;
    }

    public function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }
}
