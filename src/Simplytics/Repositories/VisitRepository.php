<?php

namespace NemC\Simplytics\Repositories;

use Illuminate\Support\Facades\Response;
use NemC\Simplytics\Models\VisitModel as Model;

class VisitRepository implements VisitInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    public function store($data)
    {
        $new = $this->model->create($data);
        return $new;
    }

    public function createTable()
    {
        dd($this->model->getTable());
    }
}