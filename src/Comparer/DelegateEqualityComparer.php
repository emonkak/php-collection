<?php

namespace Emonkak\Collection\Comparer;

class DelegateEqualityComparer implements IEqualityComparer
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
        return call_user_func($this->equalsFn, $v0, $v1);
    }

    public function hash($v)
    {
        return call_user_func($this->hashFn, $v);
    }
}
