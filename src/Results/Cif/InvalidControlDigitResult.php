<?php

namespace Hawara\VatNumbers\Results\Cif;

use Hawara\VatNumbers\ValidationResult;

class InvalidControlDigitResult extends ValidationResult
{
    public function __construct()
    {
        parent::__construct(false, 'The control digit is not valid.');
    }
}
