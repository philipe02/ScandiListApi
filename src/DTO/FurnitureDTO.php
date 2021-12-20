<?php

namespace Src\DTO;

class FurnitureDTO extends ProductDTO
{
    public static function createProductDTO($product)
    {
        return array(
            'sku' => $product->getSku(),
            'productType' => $product->getProductType(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'height' => $product->getHeight(),
            'width' => $product->getWidth(),
            'length' => $product->getLength()
        );
    }
}
