<?php

namespace NemC\Simplytics\Providers;

use Illuminate\Support\ServiceProvider,
    Illuminate\Support\Facades\Request;

class DomainServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->registerStoreService();
    }

    protected function registerStoreService()
    {
        $this->app->bind('StoreService', function(){
            return new StoreService(
                $this->app->make('NemC\Repositories\VisitRepository'),
                $this->app->make('NemC\Repositories\VisitMetaRepository'));
        });
    }
}