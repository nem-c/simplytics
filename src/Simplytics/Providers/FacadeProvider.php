<?php

namespace NemC\Simplytics\Providers;

use Illuminate\Support\ServiceProvider,
    Illuminate\Foundation\AliasLoader;

class FacadeProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->booting(function () {
            AliasLoader::getInstance()->alias('GifResponse', 'NemC\Simplytics\Facades\GifResponse');
            AliasLoader::getInstance()->alias('JavaScriptResponse', 'NemC\Simplytics\Facades\JavaScriptResponse');
        });
    }
}