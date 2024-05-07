<?php

namespace Hawara\VatNumbers\Results\NifNie;

use Hawara\VatNumbers\ValidationResult;

class MustFollowThePatternResult extends ValidationResult
{
    public function __construct()
    {
        parent::__construct(false, 'The value must follow the correct pattern for NIF\'s or NIE\'s, including its control digit.');
    }
}
