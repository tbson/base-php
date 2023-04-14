<?php

namespace Prog\UseCase\Config\Variable;
use Illuminate\Support\Facades\Validator;
use Prog\Srv\Config\Schema\VariableSchema;
use Prog\Util\ErrorUtil;

/*
 * @module Prog\UseCase\Config\Variable\VariableValidator;
 */
class VariableValidator
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
