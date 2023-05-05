<?php

namespace Src\Interface\Config;

/**
 * Interface Variable
 * @package Src\Interface\Config\Variable;
 */
interface Variable {
    public static function getSchema();
    public static function getVariable($conditions);
    public static function createVariable($attrs);
    public static function updateVariable($conditions, $attrs);
    public static function deleteVariable($conditions, $id);
    public static function deleteVariables($conditions, $ids);
}
