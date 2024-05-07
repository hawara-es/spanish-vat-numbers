<?php

namespace Hawara\VatNumbers\Contracts;

interface Validator
{
    public function validate(mixed $value): ValidationResult;
}
