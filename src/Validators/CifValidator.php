<?php

namespace Hawara\StandardCodes\Validators;

use Hawara\StandardCodes\ValidationResult;
use Hawara\StandardCodes\Contracts\Validator;
use Hawara\StandardCodes\Results\Cif\MustBeAStringResult;
use Hawara\StandardCodes\Results\Cif\MustFollowThePatternResult;
use Hawara\StandardCodes\Contracts\ValidationResult as ValidationResultContract;
use Hawara\StandardCodes\Results\Cif\InvalidControlDigitResult;

/**
 * @link http://www.migoia.com/migoia/util/NIF/NIF.pdf
 */
class CifValidator implements Validator
{
    const MAPPING = [
        0 => 'J',
        1 => 'A',
        2 => 'B',
        3 => 'C',
        4 => 'D',
        5 => 'E',
        6 => 'F',
        7 => 'G',
        8 => 'H',
        9 => 'I',
    ];

    public function validate(mixed $value): ValidationResultContract
    {
        if (gettype($value) !== 'string') {
            return new MustBeAStringResult;
        }

        if (! $this->isCif($value)) {
            return new MustFollowThePatternResult;
        }

        $digits = substr($value, 1, -1);
        $control = substr($value, -1);

        $odds = $this->processOddDigit($digits, 0) +
          $this->processOddDigit($digits, 2) +
          $this->processOddDigit($digits, 4) +
          $this->processOddDigit($digits, 6);

        $evens = $this->processEvenDigit($digits, 1) +
            $this->processEvenDigit($digits, 3) +
            $this->processEvenDigit($digits, 5);

        $addition = (string) ($odds + $evens);
        $calculated = (10 - (int) substr($addition, -1)) % 10;

        if ($this->supportsNumericalControlDigit($value) && $calculated == $control) {
            return new ValidationResult(isValid: true);
        }

        $calculated = self::MAPPING[$calculated];

        if ($this->supportsAlphabeticalControlDigit($value) && $calculated == $control) {
            return new ValidationResult(isValid: true);
        }

        return new InvalidControlDigitResult;
    }

    /**
     * @link https://www.boe.es/eli/es/o/2008/02/20/eha451/con
     */
    private function isCif(string $value): bool
    {
        return preg_match('/^[A-Z][0-9]{7}[A-Z|0-9]$/', $value) !== 0;
    }

    private function processOddDigit(string $digits, int $position): int
    {
        $digit = $digits[$position];
        $double = (int) $digit * 2;

        if ($double < 10) {
            return $double;
        }

        $double = (string) $double;
        return $double[0] + $double[1];
    }

    private function processEvenDigit(string $digits, int $position): int
    {
        return (int) $digits[$position];
    }

    private function supportsNumericalControlDigit(string $value): bool
    {
        return preg_match('/^[ABCDEFGHJUV]$/', $value[0]) !== 0;
    }

    private function supportsAlphabeticalControlDigit(string $value): bool
    {
        return preg_match('/^[ABCDEFGKLMNPQRSW]$/', $value[0]) !== 0;
    }
}
