<?php

namespace Emonkak\Collection\Iterator;

class CycleIterator implements \Iterator
{
    private $it;
    private $n;
    private $i;

    public function __construct(\Iterator $it, $n)
    {
        $this->it = $it;
        $this->n = $n;
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

        if (!$this->it->valid()) {
            $this->i++;
            $this->it->rewind();
        }
    }

    public function rewind()
    {
        $this->i = 0;
        $this->it->rewind();
    }

    public function valid()
    {
        return $this->i < $this->n && $this->it->valid();
    }
}
