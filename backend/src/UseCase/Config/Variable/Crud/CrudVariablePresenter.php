<?php

namespace Src\UseCase\Config\Variable\Crud;

use Src\Setting;
use Src\Util\MapUtil;

/*
 * @module Src\UseCase\Config\Variable\Crud\CrudVariablePresenter;
 */
class CrudVariablePresenter {
    public static function presentList($items) {
        $result = [];
        foreach ($items as $item) {
            $result[] = self::presentItem($item);
        }
        return $result;
    }

    public static function presentItem($item) {
        return [
            "id" => $item->id,
            "uid" => $item->uid,
            "value" => $item->value,
            "description" => $item->description,
            "type" => $item->type,
            "type_label" => MapUtil::get(Setting::VARIABLE_TYPE_LABEL, $item->type, ""),
        ];
    }

    public static function presentDelete() {
        return ["ok" => true];
    }
}
