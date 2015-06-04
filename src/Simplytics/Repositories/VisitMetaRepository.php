<?php

namespace NemC\Simplytics\Repositories;

use NemC\Simplytics\Models\VisitMetaModel as Model,
    NemC\Simplytics\Models\VisitModel;

class VisitMetaRepository implements VisitMetaInterface
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

    public function storeClick(VisitModel $visit, $object, $id)
    {
        $meta = $this->store([
            'visit_id' => $visit->id,
            'event' => VisitMetaInterface::EVENT_CLICK,
            'meta_name' => $object,
            'meta_value' => $id,
        ]);
        return $meta;
    }

    public function storeView(VisitModel $visit, $object, $id)
    {
        $meta = $this->store([
            'visit_id' => $visit->id,
            'event' => VisitMetaInterface::EVENT_VIEW,
            'meta_name' => $object,
            'meta_value' => $id,
        ]);
        return $meta;
    }



    public function createTable()
    {
        dd($this->model->getTable());
    }
}