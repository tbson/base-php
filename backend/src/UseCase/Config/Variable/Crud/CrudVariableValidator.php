<?php

namespace Src\UseCase\Config\Variable\Crud;

use Illuminate\Support\Facades\Validator;
use Src\Service\Config\Schema\VariableSchema;
use Src\Util\ErrorUtil;
use Src\Setting;

/*
 * @module Src\UseCase\Config\Variable\Crud\CrudVariableValidator;
 */
class CrudVariableValidator {
    public static function validate($attrs, $action = Setting::CRUD_ACTION["CREATE"]) {
        $rules = VariableSchema::$rules;
        if ($action === Setting::CRUD_ACTION["UPDATE"]) {
            $rules = VariableSchema::$updateRules;
        }
        $validator = Validator::make($attrs, $rules, VariableSchema::$messages);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return ["error", ErrorUtil::parse($messages)];
        }
        return ["ok", $validator->validated()];
    }
}
