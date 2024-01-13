<?php

namespace App\Exceptions;

class InvalidUploadException extends \Exception
{
    public function __construct($message = '', $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function onSave(): self
    {
        return new static('The upload has failed');
    }
}
