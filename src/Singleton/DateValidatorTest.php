<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator\Singleton;

use PHPUnit\Framework\TestCase;

final class DateValidatorTest extends TestCase
{
    public function test_singleton_uses_concrete_injectable_date_validator()
    {
        $validation = DateValidator::validateHistoricalDate('01/05/2015');
        $this->assertTrue($validation->isValid());
        $this->assertNull($validation->getMessage()->getValue());
    }
}
