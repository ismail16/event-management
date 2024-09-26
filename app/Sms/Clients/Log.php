<?php

namespace App\Sms\Clients;

use App\Sms\ClientBase;
use App\Sms\Clients\Log\Result;

class Log extends ClientBase {
    protected $logger;

    protected static $messageCounter = 0;

    public function __construct($config) {
        $this->logger = app()['log'];
    }

    public function send($toNumber, $message) {
        $this->logger->info('SMS sent', ['to' => $toNumber, 'message' => $message]);
        return new Result(++self::$messageCounter);
    }

    public function getStatus($messageId) {
        return new Result($messageId);
    }
}