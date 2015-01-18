<?php

namespace Emonkak\Collection\Iterator;

class GroupJoinIterator implements \Iterator
{
    /**
     * The ourter iterator
     *
     * @var Iterator
     */
    private $outer;

    /**
     * The inner iterator
     *
     * @var Iterator
     */
    private $inner;

    /**
     * The outer key selector function
     *
     * @var callable
     */
    private $outerKeySelector;

    /**
     * The inner key selector function
     *
     * @var callable
     */
    private $innerKeySelector;

    /**
     * The inner result value selector function
     *
     * @var callable
     */
    private $resultValueSelector;

    /**
     * @var array
     */
    private $lookupTable;

    /**
     * @var mixed
     */
    private $resultValue;

    /**
     * @param \Iterator $oute
     * @param \Iterator $inner
     * @param callable $outerKeySelector
     * @param callable $innerKeySelector
     * @param callable $resultValueSelector
     */
    public function __construct(
        \Iterator $outer,
        \Iterator $inner,
        callable $outerKeySelector,
        callable $innerKeySelector,
        callable $resultValueSelector
    )
    {
        $this->outer = $outer;
        $this->inner = $inner;
        $this->outerKeySelector = $outerKeySelector;
        $this->innerKeySelector = $innerKeySelector;
        $this->resultValueSelector = $resultValueSelector;
    }

    /**
     * @see \Iterator
     * @return mixed
     */
    public function current()
    {
        return $this->resultValue;
    }

    /**
     * @see \Iterator
     * @return mixed
     */
    public function key()
    {
        return $this->outer->key();
    }

    /**
     * @see \Iterator
     */
    public function next()
    {
        $this->outer->next();
        $this->fetch();
    }

    /**
     * @see \Iterator
     */
    public function rewind()
    {
        $this->outer->rewind();
        $this->lookup();
        $this->fetch();
    }

    /**
     * @see \Iterator
     * @return boolean
     */
    public function valid()
    {
        return $this->outer->valid();
    }

    private function fetch()
    {
        if ($this->outer->valid()) {
            $outerKeySelector = $this->outerKeySelector;
            $outerValue = $this->outer->current();
            $outerKey = $this->outer->key();
            $joinKey = $outerKeySelector($outerValue, $outerKey, $this->outer);

            if (isset($this->lookupTable[$joinKey])) {
                $inners = $this->lookupTable[$joinKey];
            } else {
                $inners = [];
            }

            $resultValueSelector = $this->resultValueSelector;
            $this->resultValue = $resultValueSelector($outerValue, $inners);
        }
    }

    private function lookup()
    {
        $this->lookupTable = [];
        $innerKeySelector = $this->innerKeySelector;
        foreach ($this->inner as $innerKey => $innerValue) {
            $joinKey = $innerKeySelector($innerValue, $innerKey, $this->inner);
            $this->lookupTable[$joinKey][] = $innerValue;;
        }
    }
}
