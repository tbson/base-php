<?php

namespace Prog\Util;

use DateTime;

/**
 * @module Prog\Util\TimeUtil;
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
