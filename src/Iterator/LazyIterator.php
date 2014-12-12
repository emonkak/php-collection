<?php
/**
 * This file is part of the Emonkak\Collection.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Collection\Iterator;

use Emonkak\Collection\Util\Iterators;

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
