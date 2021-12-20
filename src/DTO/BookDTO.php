<?php

namespace Src\DTO;

class BookDTO extends ProductDTO
{

    public static function createProductDTO($product)
    {
        return array(
            'sku' => $product->getSku(),
            'productType' => $product->getProductType(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'weight' => $product->getWeight()
        );
    }
}
