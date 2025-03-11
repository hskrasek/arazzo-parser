<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

use HSkrasek\Arazzo\Specification\Actions\Failure;
use HSkrasek\Arazzo\Specification\Actions\Success;

final readonly class Workflow
{
    /**
     * @param  Step[]  $steps
     * @param  Success[]  $successActions
     * @param  Failure[]  $failureActions
     * @param  array<non-empty-string, string>  $outputs
     * @param  Parameter[]  $parameters
     * @param  list<string>  $dependsOn
     */
    public function __construct(
        public string $workflowId,
        public array $steps,
        public ?string $summary,
        public ?string $description,
        public array $inputs = [],
        public array $successActions = [],
        public array $failureActions = [],
        public array $outputs = [],
        public array $parameters = [],
        public array $dependsOn = [],
    ) {}
}
