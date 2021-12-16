<?php

namespace Src\Model;

class Book extends Product
{

    private Float $weight;

    public function __construct($sku, $productType, $name, $price, $weight)
    {
        $this->sku = strval($sku);
        $this->productType = intval($productType);
        $this->name = strval($name);
        $this->price = floatval($price);
        $this->weight = floatval($weight);
    }

    public function getWeight()
    {
        return $this->weight;
    }

    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
}
