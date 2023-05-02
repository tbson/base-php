<?php
namespace Src\Service\Verify;

use Src\Service\Verify\Schema\OtpSchema;
use Src\Service\DbService;

/**
 * @module Src\Service\Verify\OtpService;
 */
class OtpService {
    private static function getNotFoundMsg() {
        return __("OTP not found");
    }

    public static function getOtp($conditions) {
        return DbService::getItem(
            OtpSchema::class,
            $conditions,
            self::getNotFoundMsg(),
        );
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
