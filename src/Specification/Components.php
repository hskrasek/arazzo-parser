<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification;

final readonly class Components
{
    /**
     * @param  array<non-empty-string, string>  $inputs
     * @param  array<non-empty-string, Parameter>  $parameters
     * @param  array<non-empty-string, Actions\Success>  $successActions
     * @param  array<non-empty-string, Actions\Failure>  $failureActions
     */
    public function __construct(
        public array $inputs,
        public array $parameters,
        public array $successActions,
        public array $failureActions,
    ) {}
}
