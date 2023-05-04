<?php

namespace Src\UseCase\Account\Profile\UpdateProfile;

use Illuminate\Support\Facades\Validator;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Account\Profile\UpdateProfile\UpdateProfileValidator;
 */
class UpdateProfileValidator {
    public static function validateUpdateProfile($attrs) {
        $rules = [
            "name" => "required|string",
            "email" => "required|email",
            "mobile" => "string",
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
