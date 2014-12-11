<?php

namespace Emonkak\Collection\Tests;

use Emonkak\Collection\Provider\IteratorProvider;

class IteratorCollectionTest extends AbstractLazyCollectionTest
{
    protected function getCollectionProvider()
    {
        return IteratorProvider::getInstance();
    }
}
