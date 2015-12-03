<?php

namespace Emonkak\Collection\Iterator;

use Emonkak\Collection\Utils\Iterators;

class LazyIterator implements \Iterator
{
    private $factory;

    private $it;

    public function __construct(callable $factory)
    {
        $this->factory = $factory;
    }

    public function current()
    {
        return $this->it->current();
    }

    public function key()
    {
        return $this->it->key();
    }

    public function next()
    {
        $this->it->next();
    }

    public function rewind()
    {
        $factory = $this->factory;
        $this->it = Iterators::create($factory());
        $this->it->rewind();
    }

    public function valid()
    {
        return $this->it->valid();
    }
}
