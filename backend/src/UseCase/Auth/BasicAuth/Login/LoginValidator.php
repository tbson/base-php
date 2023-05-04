<?php

namespace Src\UseCase\Auth\BasicAuth\Login;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\BasicAuth\Login\LoginValidator;
 */
class LoginValidator {
    public static function validateLogin($attrs) {
        $rules = [
            "username" => "required",
            "password" => "required|string|min:8",
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
