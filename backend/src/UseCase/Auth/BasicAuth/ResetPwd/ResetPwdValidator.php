<?php

namespace Src\UseCase\Auth\BasicAuth\ResetPwd;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\BasicAuth\ResetPwd\ResetPwdValidator;
 */
class ResetPwdValidator {
    public static function validateRequestResetPwd($attrs) {
        $rules = [
            "username" => "required|string",
        ];
        $ruleMessages = [];

        $validator = Validator::make($attrs, $rules, $ruleMessages);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return ["error", ErrorUtil::parse($messages)];
        }
        return ["ok", $validator->validated()];
    }

    public static function validateConfirmResetPwd($attrs) {
        $rules = [
            "username" => "required|string",
            "otp_id" => "required|string",
            "otp_code" => "required|string",
            "password" => "required|string",
            "password_confirm" => "required|string",
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
