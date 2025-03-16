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
     * @return array<array-key, mixed>
     *
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
     * @param resource $resource
     *
     * @return array<array-key, mixed>
     * @throws IOException
     */
    public static function fromResource($resource): array
    {
        $contents = stream_get_contents($resource);
        $meta = stream_get_meta_data($resource);

        if ($contents === false) {
            throw IOException::unableToReadFile(new SplFileObject($meta['uri']));
        }

        $mimeType = mime_content_type($resource);

        if ($mimeType === false || $mimeType === 'text/plain') {
            $mimeType = self::mimeTypeForExtension(
                extension: pathinfo($meta['uri'], PATHINFO_EXTENSION),
            );
        }

        return match ($mimeType) {
            'application/json' => self::fromJson($contents),
            'text/yaml' => self::fromYaml($contents),
            default => throw IOException::unsupportedMimeType($meta['uri'], $mimeType ?: 'unknown'),
        };
    }

    /**
     * @return array<array-key, mixed>
     *
     * @throws IOException
     */
    public static function fromJson(string $jsonString): array
    {
        try {
            return (array) json_decode(
                $jsonString,
                associative: true,
                flags: JSON_THROW_ON_ERROR,
            );
        } catch (JsonException $exception) {
            throw IOException::invalidJson($exception);
        }
    }

    /**
     * @return array<array-key, mixed>
     *
     * @throws IOException
     */
    public static function fromYaml(string $yamlString): array
    {
        try {
            return (array) Yaml::parse($yamlString);
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
            (string) $file->fread(length: $file->getSize()),
            FILEINFO_MIME_TYPE,
        );

        if ($mimeType === false) {
            throw IOException::unableToExtractMimeType($file);
        }

        if ($mimeType !== 'text/plain') {
            return $mimeType;
        }

        $extension = $file->getExtension();

        return self::mimeTypeForExtension($extension);
    }

    /**
     * @param string $extension
     * @return string
     */
    public static function mimeTypeForExtension(string $extension): string
    {
        return match ($extension) {
            'json' => 'application/json',
            'yaml', 'yml' => 'text/yaml',
            default => 'text/plain',
        };
    }
}
