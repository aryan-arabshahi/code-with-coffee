<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class PageStatus extends Enum
{
    const PENDING = 'pending';
    const ENABLED = 'enabled';
    const DISABLED = 'disabled';
}
