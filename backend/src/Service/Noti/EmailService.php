<?php
namespace Src\Service\Noti;

use Illuminate\Support\Facades\Mail;

/**
 * Class EmailService
 * @package Src\Service\Noti\EmailService
 */
class EmailService
{
    public static function sendEmail($recipients, $subject, $body)
    {
        Mail::send([], [], function ($message) use ($recipients, $subject, $body) {
            $message
                ->from(env("EMAIL_DEFAULT_FROM"), env("EMAIL_DEFAULT_NAME"))
                ->to($recipients)
                ->subject($subject)
                ->html($body);
        });
    }
}
