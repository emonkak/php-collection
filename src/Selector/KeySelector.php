<?php

namespace Emonkak\Collection\Selector;

use Emonkak\Collection\Utils\Singleton;

/**
 * Represents the Identity function.
 */
class KeySelector
{
    use Singleton;

    private function __construct()
    {
    }

    /**
     * Returns the given key as it is.
     *
     * @param mixed $v
     * @param mixed $k
     * @param mixed $src
     * @return mixed
     */
    public function __invoke($v, $k, $src)
    {
        return $k;
    }
}
