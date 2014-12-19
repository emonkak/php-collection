<?php

namespace Emonkak\Collection\Comparer;

use Emonkak\Collection\Utils\Singleton;

class ComparerResolver implements IComparerResolver
{
    use Singleton;

    private function __construct()
    {
    }

    public function resolveComparer($src)
    {
        if ($src === null) {
            return DefaultComparer::getInstance();
        }
        if (is_callable($src)) {
            return $src;
        }

        $type = gettype($src);
        throw new \InvalidArgumentException("Invalid comparer, got '$type'.");
    }
}
