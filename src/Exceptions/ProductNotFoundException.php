<?php

namespace Src\Exceptions;

class ProductNotFoundException extends GenericException
{

    public function __construct(string $error)
    {
        $this->message = 'Product not found!';
        $this->error = $error;
    }
    public function getErrorMessage()
    {
        return json_encode(array('message' => $this->message, 'error' => $this->error));
    }
}
