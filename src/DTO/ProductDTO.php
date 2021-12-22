<?php

namespace Src\DTO;

use Src\Model\Book;
use Src\Model\Dvd;
use Src\Model\Furniture;

class ProductDTO
{

    public static function createProductDTO($product)
    {
        switch ($product['product_type']) {
            case 1:
                $product = new Dvd($product['sku'], $product['product_type'], $product['name'], $product['price'], $product['size']);
                $productDTO = DvdDTO::createProductDTO($product);
                break;
            case 2:
                $product = new Furniture($product['sku'], $product['product_type'], $product['name'], $product['price'], $product['height'], $product['width'], $product['length']);
                $productDTO = FurnitureDTO::createProductDTO($product);
                break;
            case 3:
                $product = new Book($product['sku'], $product['product_type'], $product['name'], $product['price'], $product['weight']);
                $productDTO = BookDTO::createProductDTO($product);
                break;
            default:
                $productDTO = 'Not a valid type.';
                break;
        }
        return $productDTO;
    }
}
