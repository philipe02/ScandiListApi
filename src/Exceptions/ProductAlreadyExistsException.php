<?php

namespace Src\Exceptions;

class ProductAlreadyExistsException extends GenericException
{
    public string $stackTrace;

    public function __construct(string $stackTrace)
    {
        $this->message = 'Product SKU already exists!';
        $this->stackTrace = $stackTrace;
    }
    public function getErrorMessage()
    {
        return json_encode(array('message' => $this->message, 'stackTrace' => $this->stackTrace));
    }
}
