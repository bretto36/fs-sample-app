<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class BookStatus extends Enum
{
    const NOT_STARTED = 'NOT_STARTED';
    const STARTED = 'STARTED';
    const FINISHED = 'FINISHED';
    const RETIRED = 'RETIRED';
}
