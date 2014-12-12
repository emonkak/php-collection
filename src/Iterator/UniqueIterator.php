<?php
/**
 * This file is part of the Emonkak\Collection.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Collection\Iterator;

use Emonkak\Collection\Comparer\EqualityComparer;
use Emonkak\Collection\Set;

class UniqueIterator implements \Iterator
{
    private $it;
    private $selector;
    private $eqComparer;
    private $set;
    private $current;
    private $key;

    public function __construct(\Iterator $it, callable $selector, EqualityComparer $eqComparer)
    {
        $this->it = $it;
        $this->selector = $selector;
        $this->eqComparer = $eqComparer;
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
        $this->set = new Set($this->eqComparer);
        $this->it->rewind();
        $this->fetch();
    }

    public function valid()
    {
        return $this->it->valid();
    }

    private function fetch()
    {
        while ($this->it->valid()) {
            $this->key = $this->it->key();
            $this->current = $this->it->current();
            if ($this->set->add(call_user_func(
                $this->selector,
                $this->current,
                $this->key,
                $this->it
            ))) {
                break;
            } else {
                $this->it->next();
            }
        }
    }
}
