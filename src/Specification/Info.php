<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

final readonly class Info
{
    public function __construct(
        public string $title,
        public string $version,
        public ?string $summary = null,
        public ?string $description = null,
    ) {}
}
