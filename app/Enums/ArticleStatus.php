<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ArticleStatus extends Enum
{
    const PENDING = 'pending';
    const ENABLED = 'enabled';
    const DISABLED = 'disabled';
}
