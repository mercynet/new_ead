<?php

namespace App\Exceptions;

class FileException extends \Exception
{
    public function __construct($message = '', $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public static function mimetypeMismatch(string $mimeTypeFrom, string $mimeTypeTo): static
    {
        return new static("The file type \"{$mimeTypeFrom}\" is not the same of declared \"{$mimeTypeTo}\"");
    }

    public static function invalidMimetype(): static
    {
        return new static('The file type is not supported');
    }

    public static function invalidFilesize(): static
    {
        return new static('The file size is not supported');
    }
}
