<?php

namespace NemC\Simplytics\Facades;

use Illuminate\Support\Facades\Response;

class GifResponse extends Response
{
    public static function make1pxTransparent()
    {
        return parent::make(base64_decode('R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7'), 200, [
            'Content-Type' => 'image/gif',
        ]);
    }
}