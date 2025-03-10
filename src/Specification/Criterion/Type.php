<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification\Criterion;

enum Type: string
{
    case Simple = 'simple';

    case Regex = 'regex';

    case JsonPath = 'jsonpath';

    case XPath = 'xpath';
}
