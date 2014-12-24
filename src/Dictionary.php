<?php

namespace Emonkak\Collection;

use Emonkak\Collection\Comparer\EqualityComparer;
use Emonkak\Collection\Comparer\EqualityComparerInterface;
use Emonkak\Collection\Iterator\DictionaryIterator;

class Dictionary implements \ArrayAccess, \Countable, \IteratorAggregate
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
        return new Dictionary(EqualityComparer::getInstance());
    }

    /**
     * @param EqualityComparerInterface $eqComparer
     */
    public function __construct(EqualityComparerInterface $eqComparer)
    {
        $this->eqComparer = $eqComparer;
    }

    /**
     * @param mixed $key
     * @return boolean
     */
    public function contains($key)
    {
        $hash = $this->eqComparer->hash($key);
        if (isset($this->buckets[$hash])) {
            foreach ($this->buckets[$hash] as $entry) {
                if ($this->eqComparer->equals($entry[0], $key)) {
                    return true;
                }
            }
        }
        return false;
    }

    /**
     * @param mixed $key
     * @return mixed|null
     */
    public function get($key)
    {
        $hash = $this->eqComparer->hash($key);
        if (isset($this->buckets[$hash])) {
            foreach ($this->buckets[$hash] as $entry) {
                if ($this->eqComparer->equals($entry[0], $key)) {
                    return $entry[1];
                }
            }
        }
        return null;
    }

    /**
     * @param mixed $key
     * @param mixed $value
     * @return mixed|null
     */
    public function put($key, $value)
    {
        $hash = $this->eqComparer->hash($key);
        if (isset($this->buckets[$hash])) {
            foreach ($this->buckets[$hash] as $i => &$entry) {
                if ($this->eqComparer->equals($entry[0], $key)) {
                    $oldValue = $entry[1];
                    $entry[1] = $value;
                    return $oldValue;
                }
            }
        } else {
            $this->buckets[$hash] = [];
        }
        $this->buckets[$hash][] = [$key, $value];
        $this->size++;
        return null;
    }

    /**
     * @param array|\Traversable $elements
     */
    public function putAll($elements)
    {
        foreach ($elements as $key => $value) {
            $this->put($key, $value);
        }
    }

    /**
     * @param mixed $key
     * @return boolean
     */
    public function remove($key)
    {
        $hash = $this->eqComparer->hash($key);
        if (isset($this->buckets[$hash])) {
            $bucket = &$this->buckets[$hash];
            foreach ($bucket as $i => $entry) {
                if ($this->eqComparer->equals($entry[0], $key)) {
                    unset($bucket[$i]);
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
     * @see \ArrayAccess
     * @param mixed $offset
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return $this->contains($offset);
    }

    /**
     * @see \ArrayAccess
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->get($offset);
    }

    /**
     * @see \ArrayAccess
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet($offset, $value)
    {
        $this->put($offset, $value);
    }

    /**
     * @see \ArrayAccess
     * @param mixed $offset
     */
    public function offsetUnset($offset)
    {
        $this->remove($offset);
    }

    /**
     * @see \IteratorAggregate
     * @return \Traversable
     */
    public function getIterator()
    {
        return new DictionaryIterator($this->buckets);
    }

    /**
     * {@inheritdoc}
     */
    public function getSource()
    {
        return $this->getIterator();
    }
}
