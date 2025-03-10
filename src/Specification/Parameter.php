<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

final readonly class Parameter
{
    public function __construct(
        public string $name,
        public string $in,
        public mixed $value,
    ) {}
}
