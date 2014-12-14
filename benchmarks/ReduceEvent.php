<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class ReduceEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = range(0, 1000);
        $this->f = function($acc, $x) {
            return $acc + $x;
        };
    }

    /**
     * @iterations 100
     */
    public function arrayImpl()
    {
        array_reduce($this->data, $this->f, 0);
    }

    protected function execute($xs)
    {
        $xs->reduce($this->f, 0);
    }
}
