<?php

namespace App\Sms;

use Illuminate\Support\ServiceProvider as BaseServiceProvider;
use App\Sms\Facades\SMS;
use App\Sms\ClientFactory;
use App\Sms\ClientManager;

class ServiceProvider extends BaseServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('sms.factory', function ($app) {
            return new ClientFactory($app);
        });

        $this->app->singleton('sms', function ($app) {
            return new ClientManager($app, $app['sms.factory']);
        });

        $this->app->singleton('sms.client', function ($app) {
            return $app['sms']->client();
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            'sms', 'sms.factory', 'sms.client',
        ];
    }
    
}
