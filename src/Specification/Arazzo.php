<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

final readonly class Arazzo
{
    /**
     * @param Version $arazzo
     * @param Info $info
     * @param SourceDescription[] $sourceDescriptions
     * @param Workflow[] $workflows
     * @param Components $components
     */
    public function __construct(
        public Version $arazzo,
        public Info $info,
        public array $sourceDescriptions,
        public array $workflows,
        public Components $components,
    ) {}
}
