<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class FilterEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = range(0, 100);
        $this->predicate = function($x) {
            return $x % 2 === 0;
        };
    }

    /**
     * @iterations 1000
     */
    public function array_filter()
    {
        foreach (array_filter($this->data, $this->predicate) as $x);
    }

    protected function execute($xs)
    {
        foreach ($xs->filter($this->predicate) as $x);
    }
}
