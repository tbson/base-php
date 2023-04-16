<?php
namespace Prog\Util;

use Illuminate\Support\Facades\Hash;

/**
 * @module Prog\Util\CryptoUtil;
 */
class CryptoUtil
{
    public static function hashPwd($rawPwd)
    {
        return Hash::make($rawPwd);
    }
}
