<?php

namespace Src\Model;

class Furniture extends Product
{

    private Float $height;
    private Float $width;
    private Float $length;

    public function __construct($sku, $productType, $name, $price, $height, $width, $length)
    {
        $this->sku = strval($sku);
        $this->productType = intval($productType);
        $this->name = strval($name);
        $this->price = floatval($price);
        $this->height = floatval($height);
        $this->width = floatval($width);
        $this->length = floatval($length);
    }

    public function getHeight()
    {
        return isset($this->height) ? $this->height : null;
    }

    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    public function getLength()
    {
        return $this->length;
    }

    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }
}
