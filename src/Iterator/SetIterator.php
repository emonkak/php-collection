<?php

namespace Emonkak\Collection\Iterator;

class SetIterator implements \Iterator
{
    private $outer;
    private $inner;
    private $current;
    private $index;

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
        return $this->index;
    }

    public function next()
    {
        next($this->inner);
        $this->index++;
        if (key($this->inner) === null) {
            next($this->outer);
            $this->fetchOuter();
        }
        $this->fetchInner();
    }

    public function rewind()
    {
        reset($this->outer);
        $this->index = 0;
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
            $this->current = current($this->inner);
        }
    }
}
