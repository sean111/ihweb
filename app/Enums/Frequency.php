<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

class Frequency extends Enum
{
    const ONCE = 'once';
    const WEEKLY = 'weekly';
    const BIWEEKLY = 'bi-weekly';
    const MONTHLY = 'monthly';
}