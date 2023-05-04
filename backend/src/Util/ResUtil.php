<?php
namespace Src\Util;

/**
 * @module Src\Util\ResUtil;
 */
class ResUtil {
    public static function res($data) {
        return response()->json($data, 200);
    }

    public static function err($data, $statusCode = 400) {
        return response()->json($data, $statusCode);
    }
}
