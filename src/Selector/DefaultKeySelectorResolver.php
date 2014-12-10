<?php

namespace Underbar\Selector;

use Underbar\Util\Singleton;

class DefaultKeySelectorResolver implements KeySelectorResolver
{
    use Singleton;

    private function __construct()
    {
    }

    public function resolveKeySelector($source)
    {
        if ($source === null) {
            return KeySelector::getInstance();
        }
        if (is_string($source)) {
            // key or property selector
            return function($value) use ($source) {
                return is_array($value) ? $value[$source] : $value->$source;
            };
        }
        if (is_callable($source)) {
            return $source;
        }

        $type = gettype($source);
        throw new \InvalidArgumentException("Invalid selector, got '$type'.");
    }
}
