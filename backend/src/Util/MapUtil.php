<?php
namespace Src\Util;

/*
 * @module Src\Util\MapUtil;
 */
class MapUtil {
    public static function get($arr, $key, $default = null) {
        if (array_key_exists($key, $arr)) {
            return $arr[$key];
        }
        return $default;
    }
}
