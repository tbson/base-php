<?php
namespace Src\Util;

/**
 * Class ListUtil
 * @package Src\Util
 */
class ListUtil {
    public static function mapTopOptionList($map) {
        $result = [];
        foreach ($map as $key => $value) {
            $result[] = [
                "value" => $key,
                "label" => $value,
            ];
        }
        return $result;
    }
}
