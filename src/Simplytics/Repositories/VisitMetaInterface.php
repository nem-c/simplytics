<?php

namespace NemC\Simplytics\Repositories;

use NemC\Simplytics\Models\VisitModel;

interface VisitMetaInterface
{
    const EVENT_CLICK = 1;
    const EVENT_IMPRESSION = 2;

    public function store($data);

    public function storeClick(VisitModel $visit, $object, $id);

    public function storeImpression(VisitModel $visit, $object, $id);

    public function findAllClicks($filters = []);

    public function findAllImpressions($filters = []);

    public function findAll($event, $filters = []);

    public function createTable();
}