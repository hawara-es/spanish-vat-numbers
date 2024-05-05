<?php

namespace Hawara\StandardCodes;

use Hawara\StandardCodes\Contracts\ValidationResult as ValidationResultContract;

class ValidationResult implements ValidationResultContract
{
    public function __construct(
        protected readonly bool $isValid,
        protected readonly string $errorMessage = '',
    ) {}

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function errorMessage(): string
    {
        return $this->errorMessage;
    }
}
