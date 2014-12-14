<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class UniqEvent extends AthleticEvent
{
    use CollectionBenchmark;

    public function setUp()
    {
        $this->data = array_merge(range(0, 250), range(0, 250), range(0, 250), range(0, 250));
    }

    /**
     * @iterations 100
     */
    public function arrayImpl()
    {
        foreach (array_unique($this->data) as $x);
    }

    protected function execute($xs)
    {
        foreach ($xs->uniq() as $x);
    }
}
