<?php

namespace Src\UseCase\Role\Group\Crud;

use Illuminate\Support\Facades\Validator;
use Src\Service\Role\Schema\GroupSchema;
use Src\Util\ErrorUtil;
use Src\Setting;

/*
 * @module Src\UseCase\Role\Group\Crud\CrudGroupValidator;
 */
class CrudGroupValidator {
    public static function validate($attrs, $action = Setting::CRUD_ACTION["CREATE"]) {
        $rules = GroupSchema::$rules;
        if ($action === Setting::CRUD_ACTION["UPDATE"]) {
            $rules = GroupSchema::$updateRules;
        }
        $validator = Validator::make($attrs, $rules, GroupSchema::$messages);
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return ["error", ErrorUtil::parse($messages)];
        }
        return ["ok", $validator->validated()];
    }
}
