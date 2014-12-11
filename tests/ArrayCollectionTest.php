<?php

namespace Emonkak\Collection\Tests;

use Emonkak\Collection\Collection;
use Emonkak\Collection\Provider\ArrayProvider;

class ArrayCollectionTest extends AbstractCollectionTest
{
    /**
     * @expectedException \OverflowException
     */
    public function testRepeatOfInfiniteStream()
    {
        Collection::repeat('foo');
    }

    /**
     * @expectedException \OverflowException
     */
    public function testIterate()
    {
        Collection::iterate(2, function($x) { return $x * $x; });
    }

    /**
     * @dataProvider provideCollectionFactory
     * @expectedException \OverflowException
     */
    public function testCycleOfInfiniteStream($factory)
    {
        $factory([1, 2])->cycle();
    }

    protected function getCollectionProvider()
    {
        return ArrayProvider::getInstance();
    }
}
