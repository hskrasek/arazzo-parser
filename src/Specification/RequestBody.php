<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

use HSkrasek\Arazzo\Specification\RequestBody\Replacement;

final readonly class RequestBody
{
    /**
     * @param  Replacement[]  $replacements
     */
    public function __construct(
        public string $contentType,
        public string $payload,
        public array $replacements,
    ) {}
}
