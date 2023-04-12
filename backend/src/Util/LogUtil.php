<?php
namespace Src\Util;

use Illuminate\Support\Facades\Log;

class LogUtil
{
    public static function log($input)
    {
        Log::info($input);
    }
}
