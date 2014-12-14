<?php

namespace Emonkak\Collection\Iterator;

class SampleIterator implements \Iterator
{
    private $array;
    private $candidates;
    private $n;
    private $index;
    private $current;

    public function __construct(array $array, $n)
    {
        $this->array = $array;
        $this->n = min($n, count($array));
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
        $this->fetch();
    }

    public function rewind()
    {
        $this->candidates = $this->array;
        $this->index = 0;
        $this->fetch();
    }

    public function valid()
    {
        return $this->index < $this->n;
    }

    private function fetch()
    {
        if (!empty($this->candidates)) {
            $key = array_rand($this->candidates);
            if ($key !== null) {
                $this->current = $this->candidates[$key];
                unset($this->candidates[$key]);
            }
        }
    }
}
