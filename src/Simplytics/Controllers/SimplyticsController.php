<?php

namespace NemC\Simplytics\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Config;
use Illuminate\Routing\Controller;
use NemC\Simplytics\DomainServices\StoreService;
use NemC\Simplytics\Facades\GifResponse;
use NemC\Simplytics\Facades\JavaScriptResponse;

class SimplyticsController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }

    public function index()
    {
        return Response::json('Simplytics for Laravel 4');
    }

    public function store()
    {
        $this->storeService->execute();

        return GifResponse::make1pxTransparent();
    }

    public function script()
    {
        $host = Config::get('simplytics.vars.domain');
        $jsFileContent = file_get_contents(dirname(__FILE__) . '/../../scripts/sl.js');

        if (empty($host) === false) {
            $jsFileContent = "var slh = '{$host}';" . PHP_EOL . PHP_EOL . $jsFileContent;
        }

        return JavaScriptResponse::make($jsFileContent);
    }
}
