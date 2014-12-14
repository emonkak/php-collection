<?php

namespace Emonkak\Collection\Iterator;

use Emonkak\Collection\Util\Iterators;

class FlattenIterator extends \IteratorIterator implements \RecursiveIterator
{
    private $shallow;

    public function __construct(\Iterator $it, $shallow)
    {
        parent::__construct($it);
        $this->shallow = $shallow;
    }

    public function getChildren()
    {
        $inner = Iterators::create($this->current());
        return $this->shallow
            ? new NonRecursiveIterator($inner)
            : new FlattenIterator($inner, $this->shallow);
    }

    public function hasChildren()
    {
        return Iterators::isTraversable($this->current());
    }
}
