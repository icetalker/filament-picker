<?php

namespace Icetalker\FilamentPicker\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Icetalker\FilamentPicker\FilamentPicker
 */
class FilamentPicker extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \Icetalker\FilamentPicker\Forms\Components\FilamentPicker::class;
    }
}
