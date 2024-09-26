<?php

namespace App\Sms\Clients;

use App\Sms\ClientBase;
use App\Sms\Clients\Log\Result;

class Email extends ClientBase
{
    protected $mailer;

    protected static $messageCounter = 0;

    public function __construct($config)
    {
        $this->mailer = app('mailer');
    }

    public function send($toNumber, $message)
    {
        $this->mailer->raw($message, function (\Illuminate\Mail\Message $email) use ($toNumber) {
            $email->to("{$toNumber}@octaglory.com", $toNumber);
            $email->subject("SMS for {$toNumber}");
        });
        return new Result(++self::$messageCounter);
    }

    public function getStatus($messageId)
    {
        return new Result($messageId);
    }
}
