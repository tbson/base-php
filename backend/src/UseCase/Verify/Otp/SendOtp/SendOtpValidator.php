<?php

namespace Src\UseCase\Verify\Otp\Send;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/**
 * @module Src\UseCase\Verify\Otp\Send\SendOtpValidator;
 */
class SendOtpValidator {
    public static function validateSendOtp($attrs) {
        $rules = [
            "username" => "required",
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
