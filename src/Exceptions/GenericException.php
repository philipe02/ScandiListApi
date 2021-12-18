<?php

namespace Src\Exceptions;

use Exception;

class GenericException extends Exception
{
    public string $stackTrace;

    public function __construct(string $message, string $stackTrace)
    {
        $this->message = $message;
        $this->stackTrace = $stackTrace;
    }
    public function getErrorMessage()
    {
        return json_encode(array('message' => $this->message, 'stackTrace' => $this->stackTrace));
    }
}
