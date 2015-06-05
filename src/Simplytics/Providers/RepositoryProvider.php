<?php

namespace NemC\Simplytics\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerVisitRepository();
        $this->registerVisitMetaRepository();
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
}