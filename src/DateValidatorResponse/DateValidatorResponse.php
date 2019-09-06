<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator\DateValidatorResponse;

final class DateValidatorResponse
{
    private $isValid;
    private $message;

    public function __construct(bool $isValid, DateValidatorResponseMessage $message)
    {
        $this->isValid = $isValid;
        $this->message = $message;
    }

    public function isValid(): bool
    {
        return $this->isValid;
    }

    public function getMessage(): DateValidatorResponseMessage
    {
        return $this->message;
    }
}
