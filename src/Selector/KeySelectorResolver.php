<?php

namespace Emonkak\Collection\Selector;

use Emonkak\Collection\Utils\Singleton;

class KeySelectorResolver implements IKeySelectorResolver
{
    use Singleton;

    private function __construct()
    {
    }

    public function resolveKeySelector($src)
    {
        if ($src === null) {
            return KeySelector::getInstance();
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
