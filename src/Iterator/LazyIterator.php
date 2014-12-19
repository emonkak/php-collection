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
        return Iterators::create(call_user_func($this->factory));
    }
}
