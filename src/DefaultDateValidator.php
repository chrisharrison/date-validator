<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator;

use ChrisHarrison\Clock\Clock;
use ChrisHarrison\DateValidator\DateValidatorResponse\DateValidatorResponse;
use ChrisHarrison\DateValidator\DateValidatorResponse\DateValidatorResponseMessage;
use DateTimeImmutable;

final class DefaultDateValidator implements DateValidator
{
    private $clock;

    public function __construct(Clock $clock)
    {
        $this->clock = $clock;
    }

    public function validate(string $date): DateValidatorResponse
    {
        $test = DateTimeImmutable::createFromFormat('d/m/Y', $date);
        if ($test === false) {
            return new DateValidatorResponse(
                false,
                DateValidatorResponseMessage::INVALID_FORMAT()
            );
        }
        if ($test->format('d/m/Y') !== $date) {
            return new DateValidatorResponse(
                false,
                DateValidatorResponseMessage::INVALID_DATE()
            );
        }
        if ($test >= $this->clock->now()) {
            return new DateValidatorResponse(
                false,
                DateValidatorResponseMessage::NOT_A_DATE_IN_THE_PAST()
            );
        }

        return new DateValidatorResponse(
            true,
            DateValidatorResponseMessage::null()
        );
    }
}
