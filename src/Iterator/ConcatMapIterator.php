<?php

namespace Emonkak\Collection\Iterator;

use Emonkak\Collection\Utils\Iterators;

class ConcatMapIterator implements \RecursiveIterator
{
    private $it;

    private $selector;

    private $key;

    private $current;

    private $children;

    public function __construct(\Iterator $it, callable $selector)
    {
        $this->it = $it;
        $this->selector = $selector;
    }

    public function getChildren()
    {
        $it = Iterators::create($this->children);
        return new NonRecursiveIterator($it);
    }

    public function hasChildren()
    {
        return true;
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
            $selector = $this->selector;
            $this->key = $this->it->key();
            $this->current = $this->it->current();
            $this->children = $selector($this->current, $this->key, $this->it);
        }
    }
}
