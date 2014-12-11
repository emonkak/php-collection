<?php
/**
 * This file is part of the Emonkak\Collection.php package.
 *
 * Copyright (C) 2013 Shota Nozaki <emonkak@gmail.com>
 *
 * Licensed under the MIT License
 */

namespace Emonkak\Collection\Iterator;

class NonRecursiveIterator extends \IteratorIterator implements \RecursiveIterator
{
    public function getChildren()
    {
        return null;
    }

    public function hasChildren()
    {
        return false;
    }
}
