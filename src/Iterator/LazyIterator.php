<?php

namespace Emonkak\Collection\Iterator;

use Emonkak\Collection\Utils\Iterators;

class LazyIterator implements \IteratorAggregate
{
    private $factory;

    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function getIterator()
    {
        $factory = $this->factory;
        return Iterators::create($factory());
    }
}
