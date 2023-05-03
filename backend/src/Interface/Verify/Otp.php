<?php

namespace Src\Interface\Verify;
/**
 * Interface Account
 * @package Src\Interface\Verify\Otp
 */
interface Otp {
    public static function getOtp($conditions);
    public static function createOtp($target, $ips, $extraData);
    public static function verifyOtp($id, $code);
    public static function isAllowToCreateOtp($target, $ips);
    public static function getOtpEmailInput($otp);
}
