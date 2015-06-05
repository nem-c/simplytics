<?php

namespace NemC\Simplytics\Controllers\Api\V1;

use Illuminate\Routing\Controller,
    Illuminate\Support\Facades\Response,
    Illuminate\Support\Facades\Input,
    NemC\Simplytics\Repositories\VisitMetaInterface;

class ImpressionsController extends Controller
{
    protected $visitMetaRepo;

    public function __construct(VisitMetaInterface $visitMetaRepo)
    {
        $this->visitMetaRepo = $visitMetaRepo;
    }

    public function index()
    {
        $filters = Input::all();
        foreach ($filters as $name => $value) {
            $value = urldecode($value);
            $maybeDecode = json_decode($value);
            if (is_array($maybeDecode) === true) {
                $value = $maybeDecode;
            }
            $filters[$name] = $value;
        }
        $result = $this->visitMetaRepo->findAllImpressions($filters);

        return Response::json([
            'count' => count($result),
            'data' => $result,
            'filters' => $filters,
        ]);
    }
}