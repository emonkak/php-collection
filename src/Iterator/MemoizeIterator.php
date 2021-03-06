<?php

namespace Emonkak\Collection\Iterator;

class MemoizeIterator implements \Iterator
{
    private $it;
    private $index;
    private $cachedElements = [];
    private $cachedKeys = [];
    private $cacheSize = 0;
    private $cacheCompleted = false;

    public function __construct(\Iterator $it)
    {
        $this->it = $it;
    }

    public function current()
    {
        return $this->cachedElements[$this->index];
    }

    public function key()
    {
        return $this->cachedKeys[$this->index];
    }

    public function next()
    {
        $this->index++;
        if (!$this->cacheCompleted) {
            $this->it->next();
            $this->memo();
        }
    }

    public function rewind()
    {
        $this->index = 0;
        if (!$this->cacheCompleted) {
            $this->it->rewind();
            $this->memo();
        }
    }

    public function valid()
    {
        return $this->index < $this->cacheSize;
    }

    private function memo()
    {
        if ($this->it->valid()) {
            $this->cachedElements[] = $this->it->current();
            $this->cachedKeys[] = $this->it->key();
            $this->cacheSize++;
        } else {
            $this->cacheCompleted = true;
        }
    }
}
