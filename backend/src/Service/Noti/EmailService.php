<?php
namespace Src\Service\Noti;

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Queue;
use Src\Interface\Noti\Email;

/**
 * Class EmailService
 * @package Src\Service\Noti\EmailService;
 */
class EmailService implements Email {
    public static function sendEmail($recipients, $subject, $body) {
        Mail::send([], [], function ($message) use ($recipients, $subject, $body) {
            $message
                ->from(env("EMAIL_DEFAULT_FROM"), env("EMAIL_DEFAULT_NAME"))
                ->to($recipients)
                ->subject($subject)
                ->html($body);
        });
    }

    public static function sendEmailAsync($recipients, $subject, $body) {
        Queue::push(function () use ($recipients, $subject, $body) {
            self::sendEmail($recipients, $subject, $body);
        });
    }
}
