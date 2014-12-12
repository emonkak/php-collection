<?php

namespace Emonkak\Collection\Comparer;

use Emonkak\Collection\Util\Singleton;

class EqualityComparer implements IEqualityComparer
{
    use Singleton;

    private function __construct()
    {
    }

    public function equals($x, $y)
    {
        if (is_object($x) && is_object($y)) {
            return $x == $y;
        }
        return $x === $y;
    }

    public function hash($x)
    {
        return sha1(serialize($x));
    }
}
