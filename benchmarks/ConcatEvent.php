<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class ReduceEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = range(0, 1000);
    }

    /**
     * @iterations 100
     */
    public function arrayImpl()
    {
        foreach (array_merge($this->data, $this->data) as $x);
    }

    protected function execute($xs)
    {
        foreach ($xs->concatWith($this->data) as $x);
    }
}
