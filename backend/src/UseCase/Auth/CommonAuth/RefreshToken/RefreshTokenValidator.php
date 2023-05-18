<?php

namespace Src\UseCase\Auth\CommonAuth\RefreshToken;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/**
 * Class RefreshTokenValidator
 * @package Src\UseCase\Auth\CommonAuth\RefreshToken
 */
class RefreshTokenValidator {
    public static function validateRefreshToken($attrs) {
        $rules = [
            "access_token" => "required|string",
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
