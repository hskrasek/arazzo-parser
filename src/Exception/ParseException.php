<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Exception;

use Exception;
use Throwable;

class ParseException extends Exception implements Throwable
{
    public static function invalidInput(): self
    {
        return new self(
            message: 'Unable to parse invalid input',
        );
    }
}
