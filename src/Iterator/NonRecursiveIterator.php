<?php

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
