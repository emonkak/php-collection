<?php

namespace Emonkak\Collection\Comparer;

class DelegateEqualityComparer implements EqualityComparerInterface
{
    private $equalsFn;

    private $hashFn;

    public function __construct(callable $equalsFn, callable $hashFn)
    {
        $this->equalsFn = $equalsFn;
        $this->hashFn = $hashFn;
    }

    public function equals($v0, $v1)
    {
        $equalsFn = $this->equalsFn;
        return $equalsFn($v0, $v1);
    }

    public function hash($v)
    {
        $hashFn = $this->hashFn;
        return $hashFn($v);
    }
}
