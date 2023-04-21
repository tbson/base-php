<?php

namespace Src\UseCase\Auth\BasicAuth;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Auth\BasicAuth\BasicAuthValidator;
 */
class BasicAuthValidator
{
    public static function validateLogin($attrs)
    {
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
