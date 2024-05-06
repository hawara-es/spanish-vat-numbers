# Hawara :: Standard Codes

This library provides validations for standard codes (like Spanish VAT numbers, or IBANs) in PHP.

## Usage

### NIF/NIE Validation

To use the NIF/NIE validation, first instance a `NifNieValidator`:

```php
use Hawara\StandardCodes\Validators\NifNieValidator;

$validator = new NifNieValidator;
```

Then, call `validate` to check a value.

```php
$result = $validator->validate('21207946Z');
```

A valid validation result will return `true` when its `isValid` method is called. Also, its `errorMessage` method will return an empty string.

```php
$result->isValid(); // true
$result->errorMessage(); // ""
```

An invalid validation result will return `false` when its `isValid` method is called. Its `errorMessage` method will return the reason.

```php
$result = $validator->validate('AAAAAAAAZ');

$result->isValid(); // false
$result->errorMessage() // "The value must follow the correct pattern for NIF's or NIE's, including its control digit."
```

## Development

| Dependency | Version |
| --- | --- |
| [**Pest**](https://pestphp.com) | ^2.34 |
| [Laravel **Pint**](https://laravel.com/docs/11.x/pint) | ^1.15 |
| [**Psysh**](https://psysh.org) | ^0.12 |

### Code Style

```bash
composer lint
# or vendor/bin/pint
```

### Automated Tests

```bash
composer test
# or vendor/bin/pest
```

### Interactive Tests

```bash
composer repl
# or vendor/bin/psysh
```
