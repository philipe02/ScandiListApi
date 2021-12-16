<?php

namespace Src\Model;

class Dvd extends Product
{

    private Float $size;

    public function __construct($sku, $productType, $name, $price, $size)
    {
        $this->sku = strval($sku);
        $this->productType = intval($productType);
        $this->name = strval($name);
        $this->price = floatval($price);
        $this->size = floatval($size);
    }

    public function getSize()
    {
        return $this->size;
    }

    public function setSize($size)
    {
        $this->size = $size;

        return $this;
    }
}
