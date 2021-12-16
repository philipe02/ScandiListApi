<?php

namespace Src\DTO;

use Src\Model\Book;
use Src\Model\Dvd;
use Src\Model\Furniture;
use Src\Model\Product;

class ProductDTO
{
    private String $sku;
    private Int $productType;
    private String $name;
    private Float $price;
    private Float $height;
    private Float $width;
    private Float $length;
    private Float $weight;
    private Float $size;

    public static function createProductDTO($product)
    {
        switch ($product['product_type']) {
            case 1:
                $product = new Dvd($product['sku'], $product['product_type'], $product['name'], $product['price'], $product['size']);
                $productDTO = array('sku' => $product->getSku(), 'productType' => $product->getProductType(), 'name' => $product->getName(), 'price' => $product->getPrice(), 'size' => $product->getSize());
                break;
            case 2:
                $product = new Furniture($product['sku'], $product['product_type'], $product['name'], $product['price'], $product['height'], $product['width'], $product['length']);
                $productDTO = array('sku' => $product->getSku(), 'productType' => $product->getProductType(), 'name' => $product->getName(), 'price' => $product->getPrice(), 'height' => $product->getHeight(), 'width' => $product->getWidth(), 'length' => $product->getLength());
                break;
            case 3:
                $product = new Book($product['sku'], $product['product_type'], $product['name'], $product['price'], $product['weight']);
                $productDTO = array('sku' => $product->getSku(), 'productType' => $product->getProductType(), 'name' => $product->getName(), 'price' => $product->getPrice(), 'weight' => $product->getWeight());
                break;
            default:
                $productDTO = 'Not a valid type.';
                break;
        }
        return $productDTO;
    }
}
