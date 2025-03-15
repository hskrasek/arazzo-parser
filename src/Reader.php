<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo;

use finfo;
use HSkrasek\Arazzo\Exception\IOException;
use JsonException;
use SplFileObject;
use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

use function json_decode;

final class Reader
{
    /**
     * @param SplFileObject $file
     *
     * @return array<array-key, mixed>
     * @throws IOException
     */
    public static function fromFile(SplFileObject $file): array
    {
        $fileContents = $file->fread(length: $file->getSize());

        if ($fileContents === false) {
            throw IOException::unableToReadFile($file);
        }

        return match ($mimeType = self::extractMimeType($file)) {
            'application/json' => self::fromJson($fileContents),
            'text/yaml' => self::fromYaml($fileContents),
            default => throw IOException::unsupportedMimeType($file->getFilename(), $mimeType),
        };
    }

    /**
     * @param string $jsonString
     *
     * @return array<array-key, mixed>
     * @throws IOException
     */
    public static function fromJson(string $jsonString): array
    {
        try {
            return (array)json_decode(
                $jsonString,
                associative: true,
                flags: JSON_THROW_ON_ERROR,
            );
        } catch (JsonException $exception) {
            throw IOException::invalidJson($exception);
        }
    }

    /**
     * @param string $yamlString
     *
     * @return array<array-key, mixed>
     * @throws IOException
     */
    public static function fromYaml(string $yamlString): array
    {
        try {
            return (array)Yaml::parse($yamlString);
        } catch (ParseException $exception) {
            throw IOException::invalidYaml($exception);
        }
    }

    /**
     * @throws IOException
     */
    private static function extractMimeType(SplFileObject $file): string
    {
        $fileInfo = new finfo(FILEINFO_MIME_TYPE);

        $file->seek(line: 0);

        $mimeType = $fileInfo->buffer(
            (string)$file->fread(length: $file->getSize()),
            FILEINFO_MIME_TYPE,
        );

        if ($mimeType === false) {
            throw IOException::unableToExtractMimeType($file);
        }

        return $mimeType;
    }
}
