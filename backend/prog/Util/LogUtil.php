<?php
namespace Prog\Util;

use Illuminate\Support\Facades\Log;

class LogUtil
{
    public static function log($input)
    {
        Log::info($input);
    }
}
