<?php

namespace App\Sms\Contracts;

interface Client {
    public function getName();
    public function setName($name);
    public function send($toNumber, $message);
    public function sendMultiple($toNumbers, $message);
    
}