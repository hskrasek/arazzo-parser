<?php

declare(strict_types=1);

use HSkrasek\Arazzo\Exception\ParseException;
use HSkrasek\Arazzo\Parser;
use HSkrasek\Arazzo\Specification\Arazzo;
use HSkrasek\Arazzo\Specification\Version;

describe('arazzo parser', tests: function () {
    it('parses a yaml specification', function () {
        $arazzo = Parser::parse((string) file_get_contents(__DIR__ . '/fixtures/bnpl-loan-application.yaml'));

        expect($arazzo)
            ->toBeInstanceOf(Arazzo::class)
            ->and($arazzo->arazzo)
            ->toEqual(Version::V1_0_1);
    });

    it('parses a json specification', function () {
        $arazzo = Parser::parse((string) file_get_contents(__DIR__ . '/fixtures/bnpl-loan-application.json'));

        expect($arazzo)
            ->toBeInstanceOf(Arazzo::class)
            ->and($arazzo->arazzo)
            ->toEqual(Version::V1_0_1);
    });

    it('parses a specification from a resource', function () {
        $arazzo = Parser::parse(fopen(__DIR__ . '/fixtures/bnpl-loan-application.yaml', 'r'));

        expect($arazzo)
            ->toBeInstanceOf(Arazzo::class)
            ->and($arazzo->arazzo)
            ->toEqual(Version::V1_0_1);
    });

    it('throws an exception when the specification input is invalid', function () {
        Parser::parse(null);
    })->throws(ParseException::class);
});
