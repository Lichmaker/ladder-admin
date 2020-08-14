<?php

namespace App\TraitLib;

trait Singleton
{
    protected static $instance = null;

    /**
     * @param mixed ...$args
     * @return static
     */
    public static function getInstance(...$args) {
        if (!isset(self::$instance)) {
            self::$instance = new static(...$args);
        }
        return self::$instance;
    }
}

