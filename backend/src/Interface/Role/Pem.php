<?php

namespace Src\Interface\Role;

/**
 * Interface Pem
 * @package Src\Interface\Role\Pem;
 */
interface Pem {
    public static function getPem($conditions);
    public static function createPem($attrs);
    public static function getPemOptionList();
}
