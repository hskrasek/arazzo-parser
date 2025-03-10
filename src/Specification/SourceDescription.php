<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

use HSkrasek\Arazzo\Specification\Source\Type;

final readonly class SourceDescription
{
    public function __construct(
        public string $name,
        public string $url,
        public Type $type,
    ) {}
}
