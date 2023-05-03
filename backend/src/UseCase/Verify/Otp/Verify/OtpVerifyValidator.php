<?php

namespace Src\UseCase\Verify\Otp\Verify;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/**
 * @module Src\UseCase\Verify\Otp\Verify\OtpVerifyValidator;
 */
class OtpVerifyValidator {
    public static function validateOtpVerify($attrs) {
        $rules = [
            "id" => "required|string",
            "code" => "required|string",
        ];
        $ruleMessages = [];

        $validator = Validator::make($attrs, $rules, $ruleMessages);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return ["error", ErrorUtil::parse($messages)];
        }
        return ["ok", $validator->validated()];
    }
}
