<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class GroupByEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = range(0, 1000);
        $this->selector = function($x) {
            return $x % 10;
        };
    }

    protected function execute($xs)
    {
        foreach ($xs->groupBy($this->selector) as $k => $x);
    }
}
