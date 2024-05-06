<?php

namespace Hawara\StandardCodes\Validators;

use Hawara\StandardCodes\Contracts\ValidationResult as ValidationResultContract;
use Hawara\StandardCodes\Contracts\Validator;
use Hawara\StandardCodes\Results\NifNie\InvalidControlDigitResult;
use Hawara\StandardCodes\Results\NifNie\MustBeAStringResult;
use Hawara\StandardCodes\Results\NifNie\MustFollowThePatternResult;
use Hawara\StandardCodes\ValidationResult;

/**
 * @link https://www.interior.gob.es/opencms/ca/servicios-al-ciudadano/tramites-y-gestiones/dni/calculo-del-digito-de-control-del-nif-nie/
 */
class NifNieValidator implements Validator
{
    const MAPPING = [
        0 => 'T',
        1 => 'R',
        2 => 'W',
        3 => 'A',
        4 => 'G',
        5 => 'M',
        6 => 'Y',
        7 => 'F',
        8 => 'P',
        9 => 'D',
        10 => 'X',
        11 => 'B',
        12 => 'N',
        13 => 'J',
        14 => 'Z',
        15 => 'S',
        16 => 'Q',
        17 => 'V',
        18 => 'H',
        19 => 'L',
        20 => 'C',
        21 => 'K',
        22 => 'E',
    ];

    public function validate(mixed $value): ValidationResultContract
    {
        if (gettype($value) !== 'string') {
            return new MustBeAStringResult;
        }

        if (! $this->isNie($value) && ! $this->isNif($value)) {
            return new MustFollowThePatternResult;
        }

        $digits = substr($value, 0, -1);
        $control = substr($value, -1);

        if ($this->isNie($value)) {
            $digits = str_replace('X', '0', $digits);
            $digits = str_replace('Y', '1', $digits);
            $digits = str_replace('Z', '2', $digits);
        }

        $rest = (int) $digits % 23;

        if (self::MAPPING[$rest] !== $control) {
            return new InvalidControlDigitResult;
        }

        return new ValidationResult(isValid: true);
    }

    private function isNie(string $value): bool
    {
        return preg_match('/^[X|Y|Z][0-9]{7}[A-Z]$/', $value) !== 0;
    }

    private function isNif(string $value): bool
    {
        return preg_match('/^[0-9]{8}[A-Z]$/', $value) !== 0;
    }
}
