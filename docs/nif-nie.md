# Hawara :: Spanish VAT Numbers

## NIF/NIE

### Instance

To use the NIF/NIE validation, first instance a `NifNieValidator`:

```php
use Hawara\VatNumbers\Validators\NifNieValidator;

$validator = new NifNieValidator;
```

### Validate

Then, call `validate` to check a value.

```php
$result = $validator->validate($value);
```

### Check the Result

All validation results implement the `ValidationResult` interface.

```php
use Hawara\VatNumbers\Contracts\ValidationResult;

$result instanceof ValidationResult; // true
```

What implies that they implement two methods:

```php
    public function isValid(): bool;
    public function errorMessage(): string;
```

As its name suggests, the `isValid` method returns a boolean indicating whether the value was valid.

The `errorMessage` method returns a string with the reason of the validation failure. If the value was valid, it returns an empty string.

The NIF/NIE validator returns specific validation result objects for certain errors.

#### Must Be a String

When the tested value is not even a string, a `MustBeAStringResult` object is returned.

```php
use Hawara\VatNumbers\Results\NifNie\MustBeAStringResult;

$result = $validator->validate((object) []);

$result instanceof MustBeAStringResult; // true
```

#### Must Follow the Pattern

When the tested value does not follow the pattern of a NIF or NIE, a `MustFollowThePatternResult` object is returned.

```php
use Hawara\VatNumbers\Results\NifNie\MustBeAStringResult;

$result = $validator->validate('This does not follow the pattern');

$result instanceof MustBeAStringResult; // true
```

#### Invalid Control Digit

When the tested value does not have it's correct control digit, a `InvalidControlDigit` object is returned.

```php
use Hawara\VatNumbers\Results\NifNie\InvalidControlDigitResult;

$result = $validator->validate('00000000A');

$result instanceof InvalidControlDigitResult; // true
```
