<?php

namespace NemC\Simplytics\Facades;

use Illuminate\Support\Facades\Response;

class JavaScriptResponse extends Response
{
    public static function make($code = '', $status = 200, array $headers = array())
    {
        $headers['Content-Type'] = 'text/javascript';
        return parent::make($code, $status, $headers);
    }
}