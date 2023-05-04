<?php

namespace Src\UseCase\Verify\Otp\Send;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/**
 * @module Src\UseCase\Verify\Otp\Send\OtpSendValidator;
 */
class OtpSendValidator {
    public static function validateOtpSend($attrs) {
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