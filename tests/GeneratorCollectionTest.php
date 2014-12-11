<?php

namespace Emonkak\Collection\Tests;

use Emonkak\Collection\Provider\GeneratorProvider;

/**
 * @requires PHP 5.5
 */
class GeneratorCollectionTest extends AbstractLazyCollectionTest
{
    protected function getCollectionProvider()
    {
        return GeneratorProvider::getInstance();
    }
}
