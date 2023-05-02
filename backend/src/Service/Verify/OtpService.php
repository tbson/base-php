<?php
namespace Src\Service\Verify;

use Illuminate\Database\QueryException;
use Src\Service\Verify\Schema\OtpSchema;
use Src\Util\ErrorUtil;

/**
 * @module Src\Service\Verify\OtpService;
 */
class OtpService {
    private static $notFoundMsg = __("OTP not found");

    public static function getOtp($conditions) {
        $result = OtpSchema::where($conditions)->first();
        if ($result === null) {
            return ["error", ErrorUtil::parse(self::$notFoundMsg)];
        }
        return ["ok", $result];
    }

    public static function createOtp($target, $extra_data, $ips) {
    }

    public static function verifyOtp($id, $code) {
    }

    public static function isAllowToCreateOtp($target, $ips) {
    }

    public static function getOtpEmailInput($otp) {
    }

    public static function generateOtpCode() {
    }

    public static function getOtpTemplate($code) {
    }
}
