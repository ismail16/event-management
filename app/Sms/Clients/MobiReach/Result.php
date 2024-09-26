<?php
namespace App\Sms\Clients\MobiReach;

use App\Sms\Contracts\Result as Contract;
use SimpleXMLElement;

class Result implements Contract {
    const ERROR_OCCURRED = -1;
    const PENDING = 0;
    const DELIVERED = 1;
    const PROCESSING = 2;

    protected $messageId;
    public $status;
    public $statusText;
    public $errorCode;
    public $errorText;
    public $smsCount;
    public $currentCredit;

    function __construct(SimpleXMLElement $xml) {

        foreach ($xml->children() as $child) {
            $value = (string) $child;
            switch ($child->getName()) {
            case 'MessageId':
                $this->messageId = intval($value);
                break;
            case 'Status':
                $this->status = intval($value);
                break;
            case 'StatusText':
                $this->statusText = $value;
                break;
            case 'ErrorCode':
                $this->errorCode = intval($value);
                break;
            case 'ErrorText':
                $this->errorText = $value;
                break;
            case 'SMSCount':
                $this->smsCount = intval($value);
                break;
            case 'CurrentCredit':
                $this->currentCredit = floatval($value);
                break;
            }
        }
    }

    public function getMessageId() {
        return $this->messageId;
    }

    public function isError() {
        return $this->status === self::ERROR_OCCURRED || $this->errorCode !== 0;
    }

    public function isSuccess() {
        return !$this->isError();
    }

    public function isDelivered() {
        return $this->status === self::DELIVERED;
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
            "status" => $this->status,
            "statusText" => $this->statusText,
            "errorCode" => $this->errorCode,
            "errorText" => $this->errorText,
            "smsCount" => $this->smsCount,
            "currentCredit" => $this->currentCredit
        ];
    }

    public function __toString() {
        return $this->toJson();
    }
}