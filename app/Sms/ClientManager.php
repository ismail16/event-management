<?php

namespace App\Sms;

use Illuminate\Support\Arr;
use InvalidArgumentException;
use Illuminate\Contracts\Container\Container;

class ClientManager
{
    protected $clients = [];

    protected $extensions = [];

    /**
     * Service Container instance
     * @var \Illuminate\Contracts\Container\Container;
     */
    protected $app;

    /**
     * Sms Client Factory instance
     * @var \App\Sms\ClientFactory
     */
    protected $factory;

    function __construct(Container $app, ClientFactory $factory)
    {
        $this->app     = $app;
        $this->factory = $factory;
    }

    public function client($name = null)
    {
        $name = $name ?: $this->getDefaultClient();

        // If we haven't created this connection, we'll create it based on the config
        // provided in the application. Once we've created the connections we will
        // set the "fetch mode" for PDO which determines the query return types.
        if (!isset($this->clients[$name])) {
            $this->clients[$name] = $this->makeClient($name);
        }

        return $this->clients[$name];
    }

    protected function makeClient($name)
    {
        $config = $this->configuration($name);

        // First we will check by the client name to see if an extension has been
        // registered specifically for that client. If it has we will call the
        // Closure and pass it the config allowing it to resolve the client.
        if (isset($this->extensions[$name])) {
            return $this->app->call($this->extensions[$name], [$config, $name]);
        }

        // Next we will check to see if an extension has been registered for a driver
        // and will call the Closure if so, which allows us to have a more generic
        // resolver for the drivers themselves which applies to all connections.
        if (isset($this->extensions[$driver = $config['driver']])) {
            return $this->app->call($this->extensions[$driver], [$config, $name]);
        }

        return $this->factory->make($config, $name);
    }

    protected function configuration($name)
    {
        $name = $name ?: $this->getDefaultClient();

        // To get the database client configuration, we will just pull each of the
        // client configurations and get the configurations for the given name.
        // If the configuration doesn't exist, we'll throw an exception and bail.
        $clients = $this->app['config']['sms.clients'];

        if (is_null($config = Arr::get($clients, $name))) {
            throw new InvalidArgumentException("SMS Client [$name] not configured.");
        }

        return $config;
    }

    /**
     * Get the default connection name.
     *
     * @return string
     */
    public function getDefaultClient()
    {
        return $this->app['config']['sms.default'];
    }

    /**
     * Register an extension client resolver.
     *
     * @param  string  $name
     * @param  callable  $resolver
     * @return void
     */
    public function extend($name, callable $resolver)
    {
        $this->extensions[$name] = $resolver;
    }

    /**
     * Dynamically pass methods to the default client.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
        return $this->client()->$method(...$parameters);
    }
}
