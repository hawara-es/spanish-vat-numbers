<?php

namespace Hawara\StandardCodes\Contracts;

interface ValidationResult
{
    public function isValid(): bool;

    public function errorMessage(): string;
}
