<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Exception;

use Exception;
use SplFileObject;
use Throwable;

class IOException extends Exception implements Throwable
{
    public static function unableToReadFile(SplFileObject $file): self
    {
        return new self(
            message: "Unable to read file: {$file->getRealPath()}",
        );
    }

    public static function unableToExtractMimeType(SplFileObject $file): self
    {
        return new self(
            message: "Unable to extract MIME type from file: {$file->getRealPath()}",
        );
    }

    public static function unsupportedMimeType(string $fileName, string $mimeType): self
    {
        return new self(
            message: "The file '$fileName' has an unsupported MIME type '$mimeType'.",
        );
    }

    public static function invalidJson(?Throwable $exception = null): self
    {
        return new self(
            message: "Unable to parse invalid JSON: {$exception?->getMessage()}",
            code: (int) $exception?->getCode(),
            previous: $exception,
        );
    }

    public static function invalidYaml(?Throwable $exception = null): self
    {
        return new self(
            message: "Unable to parse invalid YAML: {$exception?->getMessage()}",
            code: (int) $exception?->getCode(),
            previous: $exception,
        );
    }
}
