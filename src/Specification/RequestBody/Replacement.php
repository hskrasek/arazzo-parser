<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification\RequestBody;

final readonly class Replacement
{
    public function __construct(
        public string $target,
        public string $value,
    ) {}
}
