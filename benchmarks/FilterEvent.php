<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;
use Emonkak\Collection\Collection;

class FilterEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = range(0, 1000);
        $this->predicate = function($x) {
            return $x % 2 === 0;
        };
    }

    /**
     * @iterations 100
     */
    public function arrayImpl()
    {
        foreach (array_filter($this->data, $this->predicate) as $x);
    }

    protected function execute($xs)
    {
        foreach ($xs->filter($this->predicate) as $x);
    }
}
