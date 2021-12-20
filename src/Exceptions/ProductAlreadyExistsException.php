<?php

namespace Src\Exceptions;

class ProductAlreadyExistsException extends GenericException
{
    public string $error;

    public function __construct(string $error)
    {
        $this->message = 'Product SKU already exists!';
        $this->error = $error;
    }
    public function getErrorMessage()
    {
        return json_encode(array('message' => $this->message, 'error' => $this->error));
    }
}
