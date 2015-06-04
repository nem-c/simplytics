<?php

namespace NemC\Simplytics\Controllers;

use Illuminate\Support\Facades\Response,
    Illuminate\Routing\Controller,
    NemC\Simplytics\Services\StoreService;

class SimplyticsController extends Controller
{
    protected $storeService;

    public function __construct(StoreService $storeService)
    {
        $this->storeService = $storeService;
    }
    public function index()
    {
         return Response::make(json_encode('Simplytics for Laravel 4'), 200)->header('Content-Type', 'application/json');
    }

    public function store()
    {
        $this->storeService->execute();
        return Response::make(base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'), 200)->header('Content-Type', 'image/gif');
    }

    public function script()
    {
        return Response::make(file_get_contents(dirname(__FILE__) . '/../../scripts/sl.js'), 200)->header('Content-Type', 'text/javascript');
    }
}