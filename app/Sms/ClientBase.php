<?php

namespace App\Sms;

use App\Sms\Contracts\Client as Contract;

abstract class ClientBase implements Contract {
    protected $clientName;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function sendMultiple($toNumbers, $message) {
        $results = [];
        foreach ($toNumbers as $number) {
            $results[$number] = $this->send($number, $message);
        }
        return $results;
    }
}