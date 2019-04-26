<?php

namespace PrimitiveSocial\NestioApiWrapper\Facades;

use Illuminate\Support\Facades\Facade;

class NestioApiWrapper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'nestioapiwrapper';
    }
}
