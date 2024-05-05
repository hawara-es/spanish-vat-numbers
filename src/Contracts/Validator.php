<?php
namespace Hawara\StandardCodes\Contracts;

interface Validator
{
    public function validate(mixed $value): ValidationResult;
}
