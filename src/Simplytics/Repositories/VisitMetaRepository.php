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

    public function storeImpression(VisitModel $visit, $object, $id)
    {
        $meta = $this->store([
            'visit_id' => $visit->id,
            'event' => VisitMetaInterface::EVENT_IMPRESSION,
            'meta_name' => $object,
            'meta_value' => $id,
        ]);
        return $meta;
    }

    public function storeCustom(VisitModel $visit, $key, $value)
    {
        $meta = $this->store([
            'visit_id' => $visit->id,
            'event' => VisitMetaInterface::EVENT_CUSTOM,
            'meta_name' => $key,
            'meta_value' => $value,
        ]);
        return $meta;
    }

    public function findAllClicks($filters = [])
    {
        return $this->findAll(VisitMetaInterface::EVENT_CLICK, $filters);
    }

    public function findAllImpressions($filters = [])
    {
        return $this->findAll(VisitMetaInterface::EVENT_IMPRESSION, $filters);
    }

    public function findAll($eventCode, $filters = [])
    {
        $query = $this->model->newQuery();
        $query->join('simplytics_visit', 'visit_id', '=', 'id');
        $query->where('event', $eventCode);

        if (isset($filters['domain']) === true) {
            if (is_array($filters['domain'])) {
                $query->whereIn('domain', $filters['domain']);
            } else {
                $query->where('domain', 'LIKE', '%' . $filters['domain'] . '%');
            }
        }

        if (isset($filters['date']) === true) {
            if (is_array($filters['date']) && count($filters['date']) === 2) {
                $dates = array_map(function ($v) {
                    return date("Y-m-d H:i:s", strtotime($v));
                }, $filters['date']);
                $query->whereBetween('created_at', $dates);
            } else {
                $query->whereBetween('created_at', [
                    date("Y-m-d", strtotime($filters['date'])) . ' 00:00:00',
                    date("Y-m-d", strtotime($filters['date'])) . ' 23:59:59',
                ]);
            }
        }

        if (isset($filters['meta_name']) === true && isset($filters['meta_value']) === true) {
            $query->where('meta_name', $filters['meta_name']);

            if (is_array($filters['meta_value']) === true) {
                $query->whereIn('meta_value', $filters['meta_value']);
            } else {
                $query->where('meta_value', '=', $filters['meta_value']);
            }
        }

        $query->orderBy('id', 'desc');

        return $query->get();
    }

    public function createTable()
    {
        dd($this->model->getTable());
    }
}