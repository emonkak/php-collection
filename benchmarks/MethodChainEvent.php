<?php

namespace Emonkak\Collection\Benchmarks;

use Athletic\AthleticEvent;
use Emonkak\Collection\Collection;

class MethodChainEvent extends AthleticEvent
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
        $result = $this->data;
        $result = array_filter($result, function($x) { return $x % 2 === 0; });
        $result = array_map(function($x) { return $x * 2; }, $result);
        $result = array_merge($result, $this->data);
        for ($i = 0, $l = count($result); $i < $l; $i++) {
            $result[$i] = [$result[$i], $i];
        }
        $result = array_slice($result, 0, 100);
        foreach ($result as $x);
    }

    protected function execute($xs)
    {
        $result = $xs
            ->filter(function($x) { return $x % 2 === 0; })
            ->map(function($x) { return $x * 2; })
            ->concat($this->data)
            ->zip(Collection::range(0, INF))
            ->take(100);
        foreach ($result as $x);
    }
}
