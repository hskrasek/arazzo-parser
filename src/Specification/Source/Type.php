<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification\Source;

enum Type: string
{
    case OpenAPI = 'openapi';

    case Arazzo = 'arazzo';
}
