<?php

namespace NemC\Simplytics\Repositories;

use NemC\Simplytics\Models\VisitModel;

interface VisitMetaInterface
{
    const EVENT_CLICK = 1;
    const EVENT_VIEW = 2;

    public function store($data);

    public function storeClick(VisitModel $visit, $object, $id);

    public function storeView(VisitModel $visit, $object, $id);

    public function createTable();
}