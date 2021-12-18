<?php

namespace Src\Controller;

use Src\Service\ProductService;

class ProductController
{

    private $requestMethod;
    private $productsSku;
    private $body;

    private $productService;

    public function __construct($requestMethod, $productsSku, $body)
    {
        $this->requestMethod = $requestMethod;
        $this->productsSku = $productsSku;
        $this->body = $body;

        $this->productService = new ProductService();
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'GET':
                $response = $this->productService->getAllProducts();
                break;
            case 'POST':
                $response = $this->productService->createProduct($this->body);
                break;
            case 'DELETE':
                $response = $this->productService->deleteProducts($this->body);
                break;
            case 'OPTIONS':
                $response['status_code_header'] = 'HTTP/1.1 200 OK';
                break;
            default:
                $response = $this->productService->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }
}
