<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

final readonly class Workflow
{
    /**
     * @param string $workflowId
     * @param string $summary
     * @param string $description
     * @param array $inputs
     * @param string[] $dependsOn
     * @param Step[] $steps
     * @param Actions\Success[] $successActions
     * @param Actions\Failure[] $failureActions
     * @param array<non-empty-string, string> $outputs
     * @param Parameter[] $parameters
     */
    public function __construct(
        public string $workflowId,
        public string $summary,
        public string $description,
        public array $inputs,
        public array $dependsOn,
        public array $steps,
        public array $successActions,
        public array $failureActions,
        public array $outputs,
        public array $parameters,
    ) {}
}
