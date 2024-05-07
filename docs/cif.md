# Hawara :: Spanish VAT Numbers

## CIF

### Instance

To use the CIF validation, first instance a `CifValidator`:

```php
use Hawara\VatNumbers\Validators\CifValidator;

$validator = new CifValidator;
```

### Validate

Then, call `validate` to check a value.

```php
$result = $validator->validate($value);
```

### Check the Result

As with [NIF/NIE validations](nif-nie.md), all validation results implement the `ValidationResult` interface.

#### Must Be a String

When the tested value is not even a string, a `MustBeAStringResult` object is returned.

```php
use Hawara\VatNumbers\Results\Cif\MustBeAStringResult;

$result = $validator->validate((object) []);

$result instanceof MustBeAStringResult; // true
```

#### Must Follow the Pattern

When the tested value does not follow the pattern of a CIF, a `MustFollowThePatternResult` object is returned.

```php
use Hawara\VatNumbers\Results\Cif\MustBeAStringResult;

$result = $validator->validate('This does not follow the pattern');

$result instanceof MustBeAStringResult; // true
```

#### Invalid Control Digit

When the tested value does not have it's correct control digit, a `InvalidControlDigit` object is returned.

```php
use Hawara\VatNumbers\Results\Cif\InvalidControlDigitResult;

$result = $validator->validate('A0000000A');

$result instanceof InvalidControlDigitResult; // true
```
