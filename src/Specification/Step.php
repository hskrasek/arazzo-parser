<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

use HSkrasek\Arazzo\Specification\Actions\Failure;
use HSkrasek\Arazzo\Specification\Actions\Success;

final readonly class Step
{
    /**
     * @param  Parameter[]  $parameters
     * @param  array<array-key, mixed> $requestBody
     * @param  Criterion[]  $successCriteria
     * @param  Success[]  $onSuccess
     * @param  Failure[]  $onFailure
     * @param  array<array-key, string>  $outputs
     */
    public function __construct(
        public string $stepId,
        public string $operationId,
        public ?string $description = null,
        public ?string $workflowId = null,
        public ?string $operationPath = null,
        public ?array $parameters = [],
        public ?array $requestBody = [],
        public array $successCriteria = [],
        public array $onSuccess = [],
        public array $onFailure = [],
        public array $outputs = [],
    ) {}
}
