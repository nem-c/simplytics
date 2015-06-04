<?php

namespace NemC\Simplytics\Models;

use Illuminate\Database\Eloquent\Model,
    Illuminate\Support\Facades\Config,
    NemC\Simplytics\Exceptions\UnsupportedMetaNameException;

class VisitMetaModel extends Model
{
    protected $table = 'simplytics_visit_meta';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'visit_id',
        'event',
        'meta_name',
        'meta_value',
    ];

    protected function setMetaNameAttribute($value)
    {
        $allowedValues = Config::get('simplytics.allowed_meta');
        if (in_array($value, $allowedValues) === false) {
            throw new UnsupportedMetaNameException(sprintf('"%s" is not in list of allowed meta properties', $value));
        }
        $this->attributes['meta_name'] = $value;
    }
}