<?php
namespace Src\Util;

use Exception;

class StrUtil
{
    public static function startsWith(string $haystack, string $needle): bool
    {
        return $needle === "" || strpos($haystack, $needle) === 0;
    }

    public static function endsWith(string $haystack, string $needle): bool
    {
        return $needle === "" || substr($haystack, -strlen($needle)) === $needle;
    }

    public static function camelToWords(string $input, $upper = false): string
    {
        try {
            $result = preg_replace(
                "/(?!^)[A-Z]{2,}(?=[A-Z][a-z])|[A-Z][a-z]/",
                ' $0',
                $input
            );
            if ($upper) {
                return ucwords(trim($result));
            }
            return trim($result);
        } catch (Exception $_e) {
            return trim($input);
        }
    }
}
