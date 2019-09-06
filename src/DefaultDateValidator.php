<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator;

use ChrisHarrison\Clock\Clock;
use ChrisHarrison\DateValidator\DateValidatorResponse\DateValidatorResponse;

final class DefaultDateValidator implements DateValidator
{
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function validate(string $date): DateValidatorResponse
    {
        // TODO: Implement validate() method.
    }
}
