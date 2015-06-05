<?php

namespace NemC\Simplytics;

use Illuminate\Support\ServiceProvider,
    NemC\Simplytics\Exceptions\ConfigMissingException;

class SimplyticsServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->package('nem-c/simplytics');
        include dirname(__FILE__) . '/../routes.php';

        $this->verifyConfig($this->app);
    }

    public function register()
    {
        $this->app->register('NemC\Simplytics\Providers\DomainServiceProvider');
        $this->app->register('NemC\Simplytics\Providers\RepositoryProvider');
    }

    protected function verifyConfig($app)
    {
        $config = $app['config']->get('simplytics');
        if (empty($config) === true) {
            throw new ConfigMissingException('Looks like you are missing configuration for simplytics');
        }
    }
}