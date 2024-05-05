<?php

namespace Hawara\StandardCodes\Results\NifNie;

use Hawara\StandardCodes\ValidationResult;

class MustBeAStringResult extends ValidationResult
{
    public function __construct() {
        parent::__construct(false, 'The value must be a string.');
    }
}
