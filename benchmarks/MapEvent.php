<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class MapEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = range(0, 1000);
        $this->selector = function($x) {
            return $x * 2;
        };
    }

    /**
     * @iterations 100
     */
    public function arrayImpl()
    {
        foreach (array_map($this->selector, $this->data) as $x);
    }

    protected function execute($xs)
    {
        foreach ($xs->map($this->selector) as $x);
    }
}
