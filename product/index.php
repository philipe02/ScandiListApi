<?php

require "../bootstrap.php";

use Src\Controller\ProductController;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: OPTIONS,GET,POST,PUT,DELETE");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = explode('/', $uri);

error_log('endpoint ' . $uri[1]);

// all of our endpoints start with /product
// everything else results in a 404 Not Found
if ($uri[1] !== 'product') {
    header("HTTP/1.1 404 Not Found");
    exit();
}

$productSku = null;
if (isset($uri[2])) {
    $productSku = $uri[2];
}



$requestMethod = $_SERVER["REQUEST_METHOD"];
$body = file_get_contents('php://input');

error_log(LOG_DEBUG, $_SERVER['REQUEST_URI'] . ' ' . $requestMethod);

$controller = new ProductController($requestMethod, $productSku, $body);
$controller->processRequest();
