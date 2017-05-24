<?php

namespace App;

trait Singleton
{
    protected static $instance;

    protected  function __construct()
    {

    }

    public static function instance()
    {
        if (null === self::$instance){
            self::$instance = new static;
        }
        return self::$instance;
    }
    protected function __clone()
    {

    }
}