<?php

namespace Hawara\VatNumbers\Results\Cif;

use Hawara\VatNumbers\ValidationResult;

class MustBeAStringResult extends ValidationResult
{
    public function __construct()
    {
        parent::__construct(false, 'The value must be a string.');
    }
}
