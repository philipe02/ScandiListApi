<?php

namespace Src\Model;

class Product
{

    protected String $sku;
    protected Int $productType;
    protected String $name;
    protected Float $price;

    public function getSku()
    {
        return isset($this->sku) ? $this->sku : null;
    }

    public function setSku($sku)
    {
        $this->sku = $sku;

        return $this;
    }

    public function getProductType()
    {
        return isset($this->productType) ? $this->productType : null;
    }

    public function setProductType($productType)
    {
        $this->productType = $productType;

        return $this;
    }

    public function getName()
    {
        return isset($this->name) ? $this->name : null;
    }

    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    public function getPrice()
    {
        return isset($this->price) ? $this->price : null;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }
}
