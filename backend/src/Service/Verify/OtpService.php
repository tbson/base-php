<?php
namespace Src\Service\Verify;

use Illuminate\Database\QueryException;
use Src\Service\Verify\Schema\OtpSchema;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Verify\OtpService;
 */
class OtpService
{
    private static $notFoundMsg = __("OTP not found");

    public static function getOtp($conditions)
    {
        $result = OtpSchema::where($conditions)->first();
        if ($result === null) {
            return ["error", ErrorUtil::parse(self::$notFoundMsg)];
        }
        return ["ok", $result];
    }

    public static function createPem($attrs)
    {
        try {
            return [true, OtpSchema::create($attrs)];
        } catch (QueryException $e) {
            return ["error", ErrorUtil::parse($e->getMessage())];
        }
    }
}
