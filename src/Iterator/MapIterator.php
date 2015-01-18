<?php

namespace Emonkak\Collection\Iterator;

class MapIterator implements \Iterator
{
    private $it;
    private $valueSelector;
    private $keySelector;
    private $current;
    private $key;

    public function __construct(\Iterator $it, callable $valueSelector, callable $keySelector)
    {
        $this->it = $it;
        $this->valueSelector = $valueSelector;
        $this->keySelector = $keySelector;
    }

    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        return $this->key;
    }

    public function next()
    {
        $this->it->next();
        $this->fetch();
    }

    public function rewind()
    {
        $this->it->rewind();
        $this->fetch();
    }

    public function valid()
    {
        return $this->it->valid();
    }

    private function fetch()
    {
        if ($this->it->valid()) {
            $keySelector = $this->keySelector;
            $valueSelector = $this->valueSelector;
            $current = $this->it->current();
            $key = $this->it->key();
            $this->key = $keySelector($current, $key, $this->it);
            $this->current = $valueSelector($current, $key, $this->it);
        }
    }
}
