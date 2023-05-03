<?php
namespace Src;

/**
 * @module Src\Setting;
 */

define("ENV_JWT_EXPIRATION_PERIOD", intval(env("JWT_EXPIRATION_PERIOD")));
define("ENV_JWT_REFRESH_PERIOD", intval(env("JWT_REFRESH_PERIOD")));
define("ENV_OTP_LIFE_TIME", intval(env("OTP_LIFE_TIME")));
define("ENV_QUOTA_OTP_PER_DAY", intval(env("OTP_QUOTA_PER_DAY")));
define("ENV_OTP_MAX_ATTEMS", intval(env("OTP_MAX_ATTEMS")));

class Setting {
    const PROFILE_TYPE = [
        "ADMIN" => 1,
        "STAFF" => 2,
    ];
    const PROFILE_TYPE_LABEL = [
        self::PROFILE_TYPE["ADMIN"] => "Admin",
        self::PROFILE_TYPE["STAFF"] => "Staff",
    ];
    const JWT_EXPIRATION_PERIOD = ENV_JWT_EXPIRATION_PERIOD;
    const JWT_REFRESH_PERIOD = ENV_JWT_REFRESH_PERIOD;
    const OTP_LIFE_TIME = ENV_OTP_LIFE_TIME;
    const OTP_QUOTA_PER_DAY = ENV_QUOTA_OTP_PER_DAY;
    const OTP_MAX_ATTEMS = ENV_OTP_MAX_ATTEMS;
}
