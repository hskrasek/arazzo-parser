<?php

declare(strict_types=1);

use HSkrasek\Arazzo\Exception\IOException;
use HSkrasek\Arazzo\Reader;

describe('arazzo reader', tests: function () {
    it('reads a yaml file', function () {
        $file = new SplFileObject(__DIR__ . '/fixtures/bnpl-loan-application.yaml');

        $contents = Reader::fromFile($file);

        expect($contents)
            ->toBeArray()
            ->and($contents)
            ->not()->toBeEmpty();
    });

    it('reads a json file', function () {
        $file = new SplFileObject(__DIR__ . '/fixtures/bnpl-loan-application.json');

        $contents = Reader::fromFile($file);

        expect($contents)
            ->toBeArray()
            ->and($contents)
            ->not()->toBeEmpty();
    });

    it('reads yaml strings', function () {
        $file = (string) file_get_contents(__DIR__ . '/fixtures/bnpl-loan-application.yaml');

        $contents = Reader::fromYaml($file);

        expect($contents)
            ->toBeArray()
            ->and($contents)
            ->not()->toBeEmpty();
    });

    it('reads json strings', function () {
        $file = (string) file_get_contents(__DIR__ . '/fixtures/bnpl-loan-application.json');

        $contents = Reader::fromJson($file);

        expect($contents)
            ->toBeArray()
            ->and($contents)
            ->not()->toBeEmpty();
    });

    it('throws an exception on broken json', function () {
        Reader::fromJson('{"status": "error",}');
    })->throws(IOException::class);

    it('throws an exception on broken yaml', function () {
        Reader::fromYaml(
            <<<YAML
            invalid-section
              key1: value1
              key2: value2
            YAML,
        );
    })->throws(IOException::class);

    it('reads from a yaml resource', function () {
        /** @var resource $resource */
        $resource = fopen(__DIR__ . '/fixtures/bnpl-loan-application.yaml', 'r');

        $contents = Reader::fromResource($resource);

        expect($contents)
            ->toBeArray()
            ->and($contents)
            ->not()->toBeEmpty();
    });

    it('reads from a json resource', function () {
        /** @var resource $resource */
        $resource = fopen(__DIR__ . '/fixtures/bnpl-loan-application.json', 'r');

        $contents = Reader::fromResource($resource);

        expect($contents)
            ->toBeArray()
            ->and($contents)
            ->not()->toBeEmpty();
    });

    it('throws an exception on failing to read the file', function () {
        $file = Mockery::mock(SplFileObject::class, ["php://memory"]);

        $file->shouldReceive('getSize')
            ->once()
            ->andReturn(0);

        $file->shouldReceive('fread')
            ->once()
            ->andReturn(false);

        $file->shouldReceive('getRealPath')
            ->once()
            ->andReturn('php://memory');

        Reader::fromFile($file);
    })->throws(IOException::class);
});
