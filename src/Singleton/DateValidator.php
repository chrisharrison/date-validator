<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator\Singleton;

use ChrisHarrison\Clock\SystemClock;
use ChrisHarrison\DateValidator\DateValidatorResponse\DateValidatorResponse;
use ChrisHarrison\DateValidator\DateValidator as InjectableDateValidator;
use ChrisHarrison\DateValidator\DefaultDateValidator as InjectableConcreteDateValidator;

final class DateValidator
{
    private static $singleton;

    private static function singleton(): InjectableDateValidator
    {
        if (static::$singleton !== null) {
            return static::$singleton;
        }

        return static::$singleton = new InjectableConcreteDateValidator(new SystemClock);
    }

    public static function validateHistoricalDate(string $dateString): DateValidatorResponse
    {
        return static::singleton()->validate($dateString);
    }
}
