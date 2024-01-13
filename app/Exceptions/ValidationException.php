<?php

namespace App\Exceptions;

use Exception;

class ValidationException extends Exception
{
    public function __construct($message = '', $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    /**
     * @return static
     */
    public static function slug(): self
    {
        return new static('The slug already exists');
    }

    /**
     * @return static
     */
    public static function emailExistent(): self
    {
        return new static('The email already exists');
    }

    /**
     * @return static
     */
    public static function installationRequired(): self
    {
        return new static('The installation is required');
    }
}
