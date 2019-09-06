<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator\DateValidatorResponse;

final class DateValidatorResponseMessage
{
    private const INVALID_DATE = 0;
    private const NOT_A_DATE_IN_THE_PAST = 1;
    private const INVALID_FORMAT = 2;

    private $value;

    private function __construct(?int $value)
    {
        $this->value = $value;
    }

    public static function INVALID_DATE(): self
    {
        return new self(self::INVALID_DATE);
    }

    public static function NOT_A_DATE_IN_THE_PAST(): self
    {
        return new self(self::NOT_A_DATE_IN_THE_PAST);
    }

    public static function INVALID_FORMAT(): self
    {
        return new self(self::INVALID_FORMAT);
    }

    public static function null(): self
    {
        return new self(null);
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function isNull(): bool
    {
        return $this->value === null;
    }
}
