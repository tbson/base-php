<?php
namespace Src\Service\Verify;

use Src\Util\TimeUtil;
use Src\Interface\Verify\Otp;
use Src\Service\DbService;
use Src\Service\Verify\Schema\OtpSchema;
use Src\Setting;

/**
 * @module Src\Service\Verify\OtpService;
 */
class OtpService implements Otp {
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

    public static function createOtp($target, $ips, $extraData = []) {
        $lifeTime = Setting::OTP_LIFE_TIME;

        $attrs = [
            "target" => $target,
            "code" => self::generateOtpCode(),
            "expired_at" => TimeUtil::now()->modify("+{$lifeTime} seconds"),
            "ips" => $ips,
            "extra_data" => $extraData,
        ];
        return DbService::createItem(OtpSchema::class, $attrs);
    }

    public static function verifyOtp($id, $code) {
        $item = OtpSchema::where(["id" => $id, "code" => $code])
            ->where("expired_at", ">", TimeUtil::now())
            ->first();
        if ($item == null) {
            return ["error", __("Can not verify OTP")];
        }
        $item->delete();
        return ["ok", $item];
    }

    public static function isAllowToCreateOtp($target, $ips) {
        $quotaPerDay = Setting::OTP_QUOTA_PER_DAY;
        $today = TimeUtil::today();
        $quota = OtpSchema::where("target", $target)
            ->whereDate("created_at", $today)
            ->whereJsonContains("ips", $ips)
            ->count();
        return $quota < $quotaPerDay;
    }

    public static function getOtpEmailInput($otp) {
        $recipient = $otp->target;
        $subject = __("OTP Verification");
        $body = self::getOtpTemplate($otp->code);
        return [$recipient, $subject, $body];
    }

    private static function generateOtpCode() {
        # 6 digits
        $randomNumber = rand(0, 999999);

        // Pad the number with leading zeros up to a length of 6
        $sixDigitNumber = str_pad($randomNumber, 6, "0", STR_PAD_LEFT);

        // Output the resulting string
        return $sixDigitNumber;
    }

    private static function getOtpTemplate($code) {
        return "
            <div>
              <p>Dear sir/madam,</p>
              <p>
                This is Your OTP code: <strong>{$code}</strong>
              </p>
              <p>Please do not share this code.</p>
              <p>Sincerely</p>
            </div>
        ";
    }
}
