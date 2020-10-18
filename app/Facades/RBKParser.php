<?php


namespace App\Facades;


use Illuminate\Support\Facades\Facade;

class RBKParser extends Facade
{
    protected static function getFacadeAccessor() {
        return \App\Services\RBKParser::class;
    }
}
