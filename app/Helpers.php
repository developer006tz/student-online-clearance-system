<?php
use App\Mail\SendMail;
if (!function_exists('sendEmail')) {
    function sendEmail($to, $name, $subject, $message)
    {
        $data = array(
            'to' => $to,
            'name' => $name,
            'subject' => $subject,
            'message' => $message
        );

        Mail::send(new SendMail($data));
    }
}