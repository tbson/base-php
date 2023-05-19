<?php

namespace Src\UseCase\Account\User\Crud;

use Illuminate\Support\Facades\Validator;
use Src\Service\Account\Schema\UserSchema;
use Src\Util\ErrorUtil;
use Src\Setting;

/*
 * @module Src\UseCase\Account\User\Crud\CrudUserValidator;
 */
class CrudUserValidator {
    public static function validate($attrs, $action = Setting::CRUD_ACTION["CREATE"]) {
        $rules = UserSchema::$rules;
        if ($action === Setting::CRUD_ACTION["UPDATE"]) {
            $rules = UserSchema::$updateRules;
        }
        $validator = Validator::make($attrs, $rules, UserSchema::$messages);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return ["error", ErrorUtil::parse($messages)];
        }
        return ["ok", $validator->validated()];
    }
}
