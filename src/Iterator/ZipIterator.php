<?php

namespace Emonkak\Collection\Iterator;

class ZipIterator implements \Iterator
{
    private $iterators = [];
    private $current;
    private $index;

    public function attach(\Iterator $it)
    {
        $this->iterators[] = $it;
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
        $this->index++;
        $this->current = [];
        foreach ($this->iterators as $it) {
            $it->next();
            $this->current[] = $it->current();
        }
    }

    public function rewind()
    {
        $this->index = 0;
        $this->current = [];
        foreach ($this->iterators as $it) {
            $it->rewind();
            $this->current[] = $it->current();
        }
    }

    public function valid()
    {
        if (empty($this->iterators)) {
            return false;
        }

        foreach ($this->iterators as $it) {
            if (!$it->valid()) {
                return false;
            }
        }

        return true;
    }
}
