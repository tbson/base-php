<?php

namespace Prog\UseCase\Config\Variable;
use Illuminate\Support\Facades\Validator;
use Prog\Srv\Config\Schema\VariableSchema;

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
            return [false, $validator->errors()->messages()];
        }
        return [true, null];
    }
}
