<?php

namespace Emonkak\Collection\Benchmarks;

use Emonkak\Collection\Collection;
use Emonkak\Collection\Provider\ArrayProvider;
use Emonkak\Collection\Provider\IteratorProvider;
use Emonkak\Collection\Provider\GeneratorProvider;

trait CollectionBenchmark
{
    /**
     * @iterations 100
     */
    public function arrayProvider()
    {
        $this->execute(new Collection($this->data, ArrayProvider::getInstance()));
    }

    /**
     * @iterations 100
     */
    public function iteratorProvider()
    {
        $this->execute(new Collection($this->data, IteratorProvider::getInstance()));
    }

    /**
     * @iterations 100
     */
    public function generatorProvider()
    {
        $this->execute(new Collection($this->data, GeneratorProvider::getInstance()));
    }

    abstract protected function execute();
}
