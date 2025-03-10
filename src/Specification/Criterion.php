<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

use HSkrasek\Arazzo\Specification\Criterion\Type;

final readonly class Criterion
{
    public function __construct(
        public string $context,
        public string $condition,
        public Type $type = Type::Simple,
    ) {}
}
