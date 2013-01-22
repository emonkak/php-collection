<?php

namespace Understrike\Lazy;

class RangeIterator implements \Iterator
{
    protected $start;

    protected $end;

    protected $step;

    protected $index;

    protected $current;

    public function __construct($start, $end, $step)
    {
        $this->start = $start;
        $this->end = $end;
        $this->step = $step;
    }

    public function current()
    {
        return $this->current;
    }

    public function key()
    {
        return $this->index;
    }

    public function next()
    {
        $this->index++;
        $this->current += $this->step;
    }

    public function rewind()
    {
        $this->index = 0;
        $this->current = $this->start;
    }

    public function valid()
    {
        return $this->start > $this->end
            ? $this->current >= $this->end
            : $this->current <= $this->end;
    }
}

// __END__
// vim: expandtab softtabstop=4 shiftwidth=4
