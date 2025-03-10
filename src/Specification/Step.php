<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

final readonly class Step
{
    /**
     * @param  Parameter[]  $parameters
     * @param  Criterion[]  $successCriteria
     * @param  Actions\Success[]  $onSuccess
     * @param  Actions\Failure[]  $onFailure
     * @param  array<non-empty-string, string>  $outputs
     */
    public function __construct(
        public string $stepId,
        public string $description,
        public string $operationId,
        public string $operationPath,
        public string $workflowId,
        public array $parameters,
        public array $requestBody,
        public array $successCriteria,
        public array $onSuccess,
        public array $onFailure,
        public array $outputs,
    ) {}
}
