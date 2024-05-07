# Hawara :: Spanish VAT Numbers

This library provides validations for Spanish VAT numbers in PHP.

## Usage

- [Validation of Spanish VAT Numbers for Individuals (NIF/NIE)](docs/nif-nie.md)
- [Validation of Spanish VAT Numbers for Organizations (CIF)](docs/cif.md)

## Development

This library has no production dependencies but its development is supported by the following ones:

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
