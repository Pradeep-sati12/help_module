<?php

namespace HelpModule\HelpModule\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \HelpModule\HelpModule\HelpModule
 */
class HelpModule extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \HelpModule\HelpModule\HelpModule::class;
    }
}
