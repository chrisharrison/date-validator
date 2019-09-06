<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator;

use ChrisHarrison\Clock\FrozenClock;
use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

final class DateValidatorTest extends TestCase
{
    public function test_it_allows_valid_leap_year_days()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation = $validator->validate('29/02/2000');

        $this->assertTrue($validation->isValid());
        $this->assertNull($validation->getMessage()->getValue());
    }

    public function test_it_disallows_invalid_leap_year_days()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation = $validator->validate('29/02/2001');

        $this->assertFalse($validation->isValid());
        $this->assertEquals(0, $validation->getMessage()->getValue());
    }

    public function test_it_disallows_impossible_dates()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation = $validator->validate('31/02/2010');

        $this->assertFalse($validation->isValid());
        $this->assertEquals(0, $validation->getMessage()->getValue());
    }

    public function test_it_allows_past_dates()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation = $validator->validate('31/03/2010');

        $this->assertTrue($validation->isValid());
        $this->assertNull($validation->getMessage()->getValue());
    }

    public function test_it_disallows_current_date()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation = $validator->validate('01/04/2010');

        $this->assertFalse($validation->isValid());
        $this->assertEquals(1, $validation->getMessage()->getValue());
    }

    public function test_it_disallows_future_dates()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation = $validator->validate('02/04/2010');

        $this->assertFalse($validation->isValid());
        $this->assertEquals(1, $validation->getMessage()->getValue());
    }

    public function test_it_disallows_invalid_format_dates()
    {
        $frozenClock = new FrozenClock(DateTimeImmutable::createFromFormat('d/m/Y', '01/04/2010'));
        $validator = new DefaultDateValidator($frozenClock);

        $validation1 = $validator->validate('complete-jibberish');
        $validation2 = $validator->validate('2000-01-01');

        $this->assertFalse($validation1->isValid());
        $this->assertEquals(2, $validation1->getMessage()->getValue());

        $this->assertFalse($validation2->isValid());
        $this->assertEquals(2, $validation2->getMessage()->getValue());
    }
}
