<?php

namespace App\Sms\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * Class SMS
 * @method static send(string $toNumber, string $message)
 *
 * @package App\Sms\Facades
 */
class SMS extends Facade {

    protected static function getFacadeAccessor() {
        return 'sms';
    }
}