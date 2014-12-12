<?php

namespace Emonkak\Collection\Iterator;

class DictionaryIterator implements \Iterator
{
    private $outer;
    private $inner;
    private $current;
    private $key;

    public function __construct(array $outer)
    {
        $this->outer = $outer;
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
        next($this->inner);
        if (key($this->inner) === null) {
            next($this->outer);
            $this->fetchOuter();
        }
        $this->fetchInner();
    }

    public function rewind()
    {
        reset($this->outer);
        $this->fetchOuter();
        $this->fetchInner();
    }

    public function valid()
    {
        return $this->inner !== null && key($this->inner) !== null;
    }

    private function fetchOuter()
    {
        while (key($this->outer) !== null) {
            $this->inner = current($this->outer);
            reset($this->inner);
            if (key($this->inner) !== null) {
                return;
            }
            next($this->outer);
        }
        $this->inner = null;
    }

    private function fetchInner()
    {
        if ($this->valid()) {
            list ($this->key, $this->current) = current($this->inner);
        }
    }
}
