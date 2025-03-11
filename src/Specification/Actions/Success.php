<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification\Actions;

use HSkrasek\Arazzo\Specification\Criterion;

final readonly class Success
{
    /**
     * @param  Criterion[]  $criteria
     */
    public function __construct(
        public string $name,
        public Type $type,
        public ?string $workflowId = null,
        public ?string $stepId = null,
        public array $criteria = [],
    ) {}
}
