<?php
namespace App\Sms\Clients\Log;

use App\Sms\Contracts\Result as Contract;

class Result implements Contract {
    protected $messageId;

    public function __construct($messageId) {
        $this->messageId = $messageId;
    }

    public function getMessageId() {
        return $this->messageId;
    }

    public function isError() {
        return false;
    }

    public function isSuccess() {
        return !$this->isError();
    }

    public function isDelivered() {
        return true;
    }

    public function toJson($options = 0) {
        return json_encode($this->jsonSerialize(), $options);
    }

    public function jsonSerialize() {
        return [
            "messageId" => $this->messageId,
            "isError" => $this->isError(),
            "isSuccess" => $this->isSuccess(),
            "isDelivered" => $this->isDelivered(),
        ];
    }

    public function __toString() {
        return $this->toJson();
    }
}