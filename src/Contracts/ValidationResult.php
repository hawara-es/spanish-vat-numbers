<?php

namespace Hawara\VatNumbers\Contracts;

interface ValidationResult
{
    public function isValid(): bool;

    public function errorMessage(): string;
}
