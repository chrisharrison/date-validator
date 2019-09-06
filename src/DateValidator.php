<?php

declare(strict_types=1);

namespace ChrisHarrison\DateValidator;

use ChrisHarrison\DateValidator\DateValidatorResponse\DateValidatorResponse;

interface DateValidator
{
    public function validate(): DateValidatorResponse;
}
