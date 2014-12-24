<?php

namespace Emonkak\Collection\Selector;

use Emonkak\Collection\Utils\Singleton;

class SelectorResolver implements SelectorResolverInterface
{
    use Singleton;

    private function __construct()
    {
    }

    public function resolveSelector($src)
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
        throw new \InvalidArgumentException("Invalid selector, got '$type'.");
    }
}
