<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\TreeMapper;
use CuyZ\Valinor\MapperBuilder;
use HSkrasek\Arazzo\Exception\IOException;
use HSkrasek\Arazzo\Exception\ParseException;
use HSkrasek\Arazzo\Specification\Arazzo;
use JsonSchema\Constraints\Constraint;
use JsonSchema\Exception\ValidationException;
use JsonSchema\Validator;
use SplFileObject;

class Parser
{
    private const string SCHEMA_URL = 'https://raw.githubusercontent.com/OAI/Arazzo-Specification/refs/heads/main/schemas/v1.0/schema.json';

    private TreeMapper $treeMapper;

    private Validator $validator;

    private function __construct(
        ?TreeMapper $treeMapper = null,
        ?Validator $validator = null,
    ) {
        $this->validator = $validator ?? new Validator();
        $this->treeMapper = $treeMapper ?? new MapperBuilder()
            ->allowPermissiveTypes()
            ->mapper();
    }

    /**
     * @param resource|string|SplFileObject $input
     *
     * @return Arazzo
     * @throws ParseException
     * @throws IOException
     * @throws MappingError
     * @throws ValidationException
     */
    public static function parse($input): Arazzo
    {
        /** @var self|null $parser */
        static $parser;

        $parser ??= new self();

        $specification = match (true) {
            ($input instanceof SplFileObject) => Reader::fromFile($input),
            is_string($input) => $parser->parseString($input),
            is_resource($input) => Reader::fromResource($input),
            default => throw ParseException::invalidInput(),
        };

        /** @throws ValidationException */
        $parser->validator->validate(
            value: $specification,
            schema: json_decode((string) file_get_contents(self::SCHEMA_URL)),
            checkMode: Constraint::CHECK_MODE_EXCEPTIONS,
        );

        return $parser->treeMapper->map(
            signature: Arazzo::class,
            source: $specification,
        );
    }

    /**
     * @param string $input
     * @return array<array-key, mixed>
     * @throws IOException
     */
    private function parseString(string $input): array
    {
        try {
            return Reader::fromJson($input);
        } catch (IOException $jsonException) {
            return Reader::fromYaml($input);
        }
    }
}
