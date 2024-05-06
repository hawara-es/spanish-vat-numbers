<?php

namespace Hawara\StandardCodes\Results\NifNie;

use Hawara\StandardCodes\ValidationResult;

class InvalidControlDigitResult extends ValidationResult
{
    public function __construct()
    {
        parent::__construct(false, 'The control digit is not valid.');
    }
}
