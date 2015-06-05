<?php

namespace NemC\Simplytics\Models;

use Illuminate\Database\Eloquent\Model,
    NemC\Simplytics\Repositories\VisitInterface,
    NemC\Simplytics\Repositories\VisitMetaInterface;

class VisitModel extends Model
{
    protected $table = 'simplytics_visit';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'long_ip',
        'cookie',
        'domain',
        'uri',
        'device',
        'user_agent',
        'source',
        'created_at',
    ];

    protected $visible = [
        'uid',
        'domain',
        'uri',
        'device',
        'user_agent',
        'source',
        'created_at',
    ];

    protected $appends = [
        'uid',
    ];

    public function getUidAttribute()
    {
        return sprintf('%s.%s', $this->attributes['cookie'], $this->attributes['long_ip']);
    }

    public function getIpAttribute()
    {
        return long2ip($this->attributes['long_ip']);
    }

    public function getDeviceAttribute()
    {
        switch ($this->attributes['device']) {
            case VisitInterface::DEVICE_MOBILE:
                $device = 'mobile';
                break;
            case VisitInterface::DEVICE_DESKTOP:
                $device = 'desktop';
                break;
            default:
                $device = 'undefined';
        }

        return $device;
    }
}