<?php

namespace Emonkak\Collection\Predicate;

use Emonkak\Collection\Selector\PropertySelectorParser;
use Emonkak\Collection\Selector\ValueSelector;
use Emonkak\Collection\Utils\Singleton;

class PredicateResolver implements IPredicateResolver
{
    use Singleton;

    private function __construct()
    {
    }

    public function resolvePredicate($src)
    {
        if ($src === null) {
            return ValueSelector::getInstance();
        }
        if (is_string($src)) {
            return PropertySelectorParser::parse($src);
        }
        if (is_callable($src)) {
            return $src;
        }

        $type = gettype($src);
        throw new \InvalidArgumentException("Invalid predicate, got '$type'.");
    }
}
