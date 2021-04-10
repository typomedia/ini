# INI Component

The INI component loads and dumps INI configs.

The Library is [PSR-1](https://www.php-fig.org/psr/psr-1/), [PSR-4](https://www.php-fig.org/psr/psr-4/), [PSR-12](https://www.php-fig.org/psr/psr-12/) compliant and fully compatible with `parse_ini_string()` for nested properties.

## Requirements

- `>= PHP 7.1`

## Dependencies

- `none`

## Install

```
composer require typomedia/ini
```

## Usage

### Parser

```php
use Typomedia\Ini\Parser;

$ini = file_get_contents('tests/Fixtures/Array.ini'); 
$parser = new Parser();
$array = $parser->parse($ini);
```

### Dumper

```php
use Typomedia\Ini\Dumper;

$array = ['Section' => ['Property' => 'Value']]; 
$dumper = new Dumper();
$ini = $dumper->dump($array);
```
