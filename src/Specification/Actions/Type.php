<?php

declare(strict_types=1);

namespace HSkrasek\Arazzo\Specification\Actions;

enum Type: string
{
    case End = 'end';

    case GoTo = 'goto';
}
