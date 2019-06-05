<?php

namespace NemC\Simplytics\Models;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Config,
    NemC\Simplytics\Exceptions\UnsupportedMetaNameException;
use NemC\Simplytics\Repositories\VisitMetaInterface;

class VisitMetaModel extends Model
{
    protected $connection = 'simplytics';
    protected $table = 'simplytics_visit_meta';
    protected $primaryKey = null;
    public $incrementing = null;
    public $timestamps = false;

    protected $fillable = [
        'visit_id',
        'event',
        'meta_name',
        'meta_value',
    ];

    protected $visible = [
        'meta_name',
        'meta_value',
        'visit',
    ];

    protected $with = [
        'visit',
    ];

    public function visit()
    {
        return $this->hasOne('NemC\Simplytics\Models\VisitModel', 'id', 'visit_id');
    }

    public function getEventAttribute()
    {
        switch ($this->attributes['event']) {
            case VisitMetaInterface::EVENT_CLICK:
                $event = 'click';
                break;
            case VisitMetaInterface::EVENT_IMPRESSION:
                $event = 'impression';
                break;
            default:
                $event = 'undefined';
        }

        return $event;
    }

    protected function setMetaNameAttribute($value)
    {
        $allowedValues = Config::get('simplytics.allowed_meta');
        if (in_array($value, $allowedValues) === false) {
            throw new UnsupportedMetaNameException(sprintf('"%s" is not in list of allowed meta properties', $value));
        }
        $this->attributes['meta_name'] = $value;
    }
}
