<?php

namespace NemC\Simplytics\Controllers;

use Illuminate\Support\Facades\Response,
    Illuminate\Routing\Controller,
    NemC\Simplytics\DomainServices\StoreService,
    NemC\Simplytics\Facades\GifResponse,
    NemC\Simplytics\Facades\JavaScriptResponse;

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
        return JavaScriptResponse::make(file_get_contents(dirname(__FILE__) . '/../../scripts/sl.js'));
    }
}