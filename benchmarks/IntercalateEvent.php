<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;

class IntercalateEvent extends AthleticEvent
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
        implode(',', $this->data);
    }

    protected function execute($xs)
    {
        $xs->intercalate(',');
    }
}
