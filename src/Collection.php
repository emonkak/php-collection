<?php

namespace Emonkak\Collection;

use Emonkak\Collection\Provider\CollectionProviderInterface;
use Emonkak\Collection\Provider\GeneratorProvider;
use Emonkak\Collection\Provider\IteratorProvider;
use Emonkak\Collection\Utils\Iterators;

class Collection implements \IteratorAggregate
{
    use Enumerable;
    use EnumerableAliases;

    private static $defaultProvider;

    private $source;

    private $provider;

    public static function from($source)
    {
        if (!Iterators::isTraversable($source)) {
            $type = gettype($source);
            throw new \InvalidArgumentException("'$type' can not be traversable.");
        }

        return new Collection($source, self::$defaultProvider);
    }

    public static function range($start, $stop = null, $step = 1)
    {
        if ($stop === null) {
            $stop = $start;
            $start = 0;
        }
        return new Collection(
            self::$defaultProvider->range($start, $stop, $step),
            self::$defaultProvider
        );
    }

    public static function iterate($initial, $f)
    {
        return new Collection(
            self::$defaultProvider->iterate($initial, $f),
            self::$defaultProvider
        );
    }

    public static function repeat($value, $n = null)
    {
        return new Collection(
            self::$defaultProvider->repeat($value, $n),
            self::$defaultProvider
        );
    }

    public static function setDefaultProvider(CollectionProviderInterface $provider)
    {
        self::$defaultProvider = $provider;
    }

    public static function getDefaultProvider()
    {
        return self::$defaultProvider;
    }

    public function __construct($source, CollectionProviderInterface $provider)
    {
        $this->source = $source;
        $this->provider = $provider;
    }

    public function getSource()
    {
        return $this->source;
    }

    public function getProvider()
    {
        return $this->provider;
    }

    public function getIterator()
    {
        return Iterators::create($this->source);
    }
}

if (class_exists('Generator')) {
    Collection::setDefaultProvider(GeneratorProvider::getInstance());
} else {
    Collection::setDefaultProvider(IteratorProvider::getInstance());
}
