<?php

namespace Src\UseCase\Auth\BasicAuth\ChangePwd;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\BasicAuth\ChangePwd\ChangePwdValidator;
 */
class ChangePwdValidator {
    public static function validateChangePwd($attrs) {
        $rules = [
            "password" => "required|string",
            "new_password" => "required|string",
            "new_password_confirm" => "required|string",
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
