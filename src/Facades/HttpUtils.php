<?php

namespace IPorto\HttpUtils\Facades;

use Illuminate\Support\Facades\Facade;

class HttpUtils extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'http-utils';
    }
}