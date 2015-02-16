<?php

namespace Emonkak\Collection\Iterator;

class OuterJoinIterator implements \Iterator
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
     * The Key of the outer iterator
     *
     * @var mixed
     */
    private $outerKey;

    /**
     * The value of the outer iterator
     *
     * @var mixed
     */
    private $outerValue;

    /**
     * @var mixed
     */
    private $resultValue;

    /**
     * @var array
     */
    private $inners = [];

    /**
     * @param \Iterator $outer
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
    ) {
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
     * @return string
     */
    public function key()
    {
        return $this->outerKey;
    }

    /**
     * @see \Iterator
     */
    public function next()
    {
        next($this->inners);
        if (key($this->inners) !== null) {
            $this->fetchResultValue();
        } else {
            $this->outer->next();
            $this->fetchInners();
        }
    }

    /**
     * @see \Iterator
     */
    public function rewind()
    {
        $this->buildLookupTable();
        $this->outer->rewind();
        $this->fetchInners();
    }

    /**
     * @see \Iterator
     * @return boolean
     */
    public function valid()
    {
        return $this->outer->valid();
    }

    private function fetchResultValue()
    {
        if ($this->outer->valid()) {
            $resultValueSelector = $this->resultValueSelector;
            $this->resultValue = $resultValueSelector($this->outerValue, current($this->inners));
        }
    }

    private function fetchInners()
    {
        if ($this->outer->valid()) {
            $this->outerValue = $this->outer->current();
            $this->outerKey = $this->outer->key();

            $outerKeySelector = $this->outerKeySelector;
            $resultValueSelector = $this->resultValueSelector;
            $joinKey = $outerKeySelector($this->outerValue, $this->outerKey, $this->outer);
            if (isset($this->lookupTable[$joinKey])) {
                $this->inners = $this->lookupTable[$joinKey];
                $this->resultValue = $resultValueSelector($this->outerValue, reset($this->inners));
            } else {
                $this->inners = [];
                $this->resultValue = $this->outerValue;
            }
        }
    }

    private function buildLookupTable()
    {
        $this->lookupTable = [];
        $innerKeySelector = $this->innerKeySelector;
        foreach ($this->inner as $innerKey => $innerValue) {
            $joinKey = $innerKeySelector($innerValue, $innerKey, $this->inner);
            $this->lookupTable[$joinKey][] = $innerValue;
        }
    }
}
