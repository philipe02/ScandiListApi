<?php

namespace Src\DTO;

class DvdDTO extends ProductDTO
{
    public static function createProductDTO($product)
    {
        return array(
            'sku' => $product->getSku(),
            'productType' => $product->getProductType(),
            'name' => $product->getName(),
            'price' => $product->getPrice(),
            'size' => $product->getSize()
        );
    }
}
