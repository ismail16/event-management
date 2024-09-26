<?php

namespace App\Sms\Contracts;

use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

interface Result extends Jsonable, JsonSerializable {
    public function getMessageId();
    public function isError();
    public function isSuccess();
    public function isDelivered();
}