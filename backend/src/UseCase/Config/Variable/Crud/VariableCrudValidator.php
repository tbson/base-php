<?php

namespace Src\UseCase\Config\Variable\Crud;

use Illuminate\Support\Facades\Validator;
use Src\Service\Config\Schema\VariableSchema;
use Src\Util\ErrorUtil;

/*
 * @module Src\UseCase\Config\Variable\VariableCrudValidator;
 */
class VariableCrudValidator
{
    public static function validate($attrs)
    {
        $validator = Validator::make(
            $attrs,
            VariableSchema::$rules,
            VariableSchema::$messages
        );
        if ($validator->fails()) {
            $messages = $validator->errors()->messages();
            return ["error", ErrorUtil::parse($messages)];
        }
        return ["ok", null];
    }
}
