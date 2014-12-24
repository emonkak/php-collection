<?php

namespace Emonkak\Collection\Comparer;

interface EqualityComparerInterface
{
    public function equals($v0, $v1);

    public function hash($v);
}
