<?php

namespace App\Sms;

use Illuminate\Contracts\Container\Container;
use InvalidArgumentException;

/**
 * Sms client factory
 */
class ClientFactory {
    /**
     * Service Container instance
     * @var \Illuminate\Contracts\Container\Container;
     */
    protected $app;

    public function __construct(Container $app) {
        $this->app = $app;
    }

    public function make(array $config, $name = null) {
        $driver = $config['driver'];
        switch ($driver) {
            case 'mobireach':
                return new Clients\MobiReach($config);
            case 'log':
                return new Clients\Log($config);
            case 'email':
                return new Clients\Email($config);
        }

        throw new InvalidArgumentException("Unsupported driver [$driver]");
    }
}
