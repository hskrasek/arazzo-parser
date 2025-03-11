<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

use HSkrasek\Arazzo\Specification\Criterion\Type;

final readonly class Criterion
{
    public function __construct(
        public string $condition,
        public ?string $context = null,
        public Type $type = Type::Simple,
    ) {}
}
