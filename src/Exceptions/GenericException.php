<?php

namespace Src\Exceptions;

use Exception;

class GenericException extends Exception
{
    public string $error;

    public function __construct(string $message, string $error)
    {
        $this->message = $message;
        $this->error = $error;
    }
    public function getErrorMessage()
    {
        return json_encode(array('message' => $this->message, 'error' => $this->error));
    }
}
