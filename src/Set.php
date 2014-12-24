<?php

namespace Emonkak\Collection;

use Emonkak\Collection\Comparer\EqualityComparer;
use Emonkak\Collection\Comparer\EqualityComparerInterface;
use Emonkak\Collection\Iterator\SetIterator;

class Set implements \Countable, \IteratorAggregate
{
    use Enumerable;
    use EnumerableAliases;

    /**
     * @var array
     */
    private $buckets = [];

    /**
     * @var integer
     */
    private $size = 0;

    /**
     * @var EqualityComparerInterface
     */
    private $eqComparer;

    public static function create()
    {
        return new Set(EqualityComparer::getInstance());
    }

    /**
     * @param EqualityComparerInterface $eqComparer
     */
    public function __construct(EqualityComparerInterface $eqComparer)
    {
        $this->eqComparer = $eqComparer;
    }

    /**
     * Add the element to this set.
     *
     * @param mixed $element
     * @return boolean
     */
    public function add($element)
    {
        $hash = $this->eqComparer->hash($element);
        if (isset($this->buckets[$hash])) {
            foreach ($this->buckets[$hash] as $entry) {
                if ($this->eqComparer->equals($entry, $element)) {
                    return false;
                }
            }
        }
        $this->buckets[$hash][] = $element;
        $this->size++;
        return true;
    }

    /**
     * Add all elements to this set.
     *
     * @param array|\Traversable $elements
     * @return boolean
     */
    public function addAll($elements)
    {
        foreach ($elements as $element) {
            $this->add($element);
        }
    }

    /**
     * Returns true if this set contains the element.
     *
     * @param mixed $element
     * @return boolean
     */
    public function contains($element)
    {
        $hash = $this->eqComparer->hash($element);
        if (isset($this->buckets[$hash])) {
            foreach ($this->buckets[$hash] as $entry) {
                if ($this->eqComparer->equals($entry, $element)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * Delete the element from this set.
     *
     * @param mixed $element
     * @return boolean
     */
    public function remove($element)
    {
        $hash = $this->eqComparer->hash($element);
        if (isset($this->buckets[$hash])) {
            foreach ($this->buckets[$hash] as $i => $entry) {
                if ($this->eqComparer->equals($entry, $element)) {
                    unset($this->buckets[$hash][$i]);
                    $this->size--;
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @see \Countable
     * @return integer
     */
    public function count()
    {
        return $this->size;
    }

    /**
     * @see \IteratorAggregate
     * @return \Traversable
     */
    public function getIterator()
    {
        return new SetIterator($this->buckets);
    }

    /**
     * {@inheritdoc}
     */
    public function getSource()
    {
        return $this->getIterator();
    }
}
