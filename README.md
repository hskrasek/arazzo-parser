# Parse Arazzo Specifications into PHP Objects

[![Latest Version on Packagist](https://img.shields.io/packagist/v/hskrasek/arazzo-parser.svg?style=flat-square)](https://packagist.org/packages/hskrasek/arazzo-parser)
[![Tests](https://img.shields.io/github/actions/workflow/status/hskrasek/arazzo-parser/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/hskrasek/arazzo-parser/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/hskrasek/arazzo-parser.svg?style=flat-square)](https://packagist.org/packages/hskrasek/arazzo-parser)

This package allows you to parse [Arazzo Specifications][1] into plain old PHP objects.

```php
use HSkrasek\Arazzo\Parser;

$specification = Parser::parse(
    file_get_contents('https://raw.githubusercontent.com/bump-sh-examples/train-travel-api/a97f549346f8cb44ec8d5e9d08cfe57b8b09cd6e/arazzo.yaml')
);

var_dump($specification);

//object(HSkrasek\Arazzo\Specification\Arazzo)#636 (5) {
//  ["arazzo"]=>
//  enum(HSkrasek\Arazzo\Specification\Version::V1_0_1)
//  ["info"]=>
//  object(HSkrasek\Arazzo\Specification\Info)#736 (4) {
//    ["title"]=>
//    string(30) "BNPL Loan Application Workflow"
//    ["version"]=>
//    string(5) "1.0.0"
//    ["summary"]=>
//    NULL
//    ["description"]=>
//    string(354) "This workflow walks through the steps to apply for a BNPL loan at checkout, including checking product eligibility, retrieving terms and conditions, creating a customer record, initiating the loan transaction, customer authentication, and retrieving the finalized payment plan. It concludes by updating the order status once the transaction is complete."
//  ...
//  }
```

## Installation

You can install the package via composer:

```bash
composer require hskrasek/arazzo-parser
```

## Usage

Your main and only entrypoint will be the Parser, which supports parsing an [Arazzo Specification][1] via many different methods and all standard formats.
```php
use HSkrasek\Arazzo\Parser;

// Parse an Arazzo specification string
$specification = Parser::parse(
    file_get_contents('https://raw.githubusercontent.com/bump-sh-examples/train-travel-api/a97f549346f8cb44ec8d5e9d08cfe57b8b09cd6e/arazzo.yaml')
);
// or parse an Arazzo specification from a file
$specification = Parser::parse(new SplFileObject(__DIR__ . '/arazzo.yaml'));

// or parse an Arazzo specification from a resource handler

$specification = Parser::parse(fopen(__DIR__ . '/arazzo.yaml'));
```

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Hunter Skrasek](https://github.com/hskrasek)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.

[1]: <https://spec.openapis.org/arazzo/latest.html> "Latest Arazzo Specification"
