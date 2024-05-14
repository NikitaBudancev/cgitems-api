<?php

namespace App\Exceptions;

use Exception;

class SaveFileException extends Exception
{
    protected mixed $data;

    public function __construct($message = '', $code = 0, ?Exception $previous = null, $data = null)
    {
        parent::__construct($message, $code, $previous);
        $this->data = $data;
    }

    /**
     * @return mixed|null
     */
    public function getData(): mixed
    {
        return $this->data;
    }
}
