<?php

namespace NemC\Simplytics\Models;

use Illuminate\Database\Eloquent\Model;

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
}