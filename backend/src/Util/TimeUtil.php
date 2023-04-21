<?php

namespace Src\Util;

use DateTime;

/**
 * @module Src\Util\TimeUtil;
 */
class TimeUtil
{
    public static function now()
    {
        return new DateTime();
    }

    public static function today()
    {
        return new DateTime("today");
    }
}
