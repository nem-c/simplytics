<?php

namespace NemC\Simplytics;

use Illuminate\Support\ServiceProvider,
    NemC\Simplytics\Services\StoreService,
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
        $this->registerVisitRepository();
        $this->registerVisitMetaRepository();

    }

    protected function registerStoreService()
    {
        $this->app->bind('StoreService', function(){
            return new StoreService(
                $this->app->make('NemC\Repositories\VisitRepository'),
                $this->app->make('NemC\Repositories\VisitMetaRepository'));
        });
    }

    protected function registerVisitRepository()
    {
        $this->app->bind('NemC\Simplytics\Repositories\VisitInterface', 'NemC\Simplytics\Repositories\VisitRepository');
    }

    protected function registerVisitMetaRepository()
    {
        $this->app->bind('NemC\Simplytics\Repositories\VisitMetaInterface',
            'NemC\Simplytics\Repositories\VisitMetaRepository');
    }

    protected function verifyConfig($app)
    {
        $config = $app['config']->get('simplytics');
        if (empty($config) === true) {
            throw new ConfigMissingException('Looks like you are missing configuration for simplytics');
        }
    }
}