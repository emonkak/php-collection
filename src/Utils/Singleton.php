<?php

namespace Emonkak\Collection\Utils;

trait Singleton
{
    /**
     * Gets the singleton instance of this class.
     *
     * @return mixed
     */
    public static function getInstance()
    {
        static $instance;

        if (!isset($instance)) {
            $instance = new static();
        }

        return $instance;
    }
}
