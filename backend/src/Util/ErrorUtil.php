<?php

namespace Src\Util;
use Illuminate\Database\QueryException;

/**
 * @module Src\Util\ErrorUtil;
 */
class ErrorUtil
{
    public static function parse($error)
    {
        # on QueryException
        if ($error instanceof QueryException) {
            return ErrorUtil::parseQueryException($error);
        }
        # on array
        if (is_array($error)) {
            return $error;
        }
        # on string
        if (is_string($error)) {
            return ["detail" => [$error]];
        }
        return ["detail" => ["unknown error"]];
    }

    private static function parseQueryException($error)
    {
        $errorMessage = $error->getMessage();
        return ["detail" => [$errorMessage]];
    }
}
