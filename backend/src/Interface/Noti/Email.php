<?php

namespace Src\Interface\Noti;
/**
 * Interface Email
 * @package Src\Interface\Noti\Email;
 */
interface Email {
    public static function sendEmail($recipients, $subject, $body);
    public static function sendEmailAsync($recipients, $subject, $body);
}
