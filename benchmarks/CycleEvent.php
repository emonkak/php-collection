<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;
use Emonkak\Collection\Collection;

class CycleEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = Collection::from(range(0, 10));
    }

    protected function execute($xs)
    {
        foreach ($xs->cycle(100) as $x);
    }
}
