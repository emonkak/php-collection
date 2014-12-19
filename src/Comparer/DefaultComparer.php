<?php

namespace Emonkak\Collection\Comparer;

use Emonkak\Collection\Utils\Singleton;

class DefaultComparer
{
    use Singleton;

    private function __construct()
    {
    }

    public function __invoke($x, $y)
    {
        if (is_string($x) && is_string($y)) {
            return strcmp($x, $y);
        }
        if (is_numeric($x) && is_numeric($y)) {
            if ($x == $y) return 0;
            return ($x < $y) ? -1 : 1;
        }
        return 0;
    }
}
