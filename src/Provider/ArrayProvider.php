<?php

namespace Underbar\Provider;

use Underbar\Util\Iterators;
use Underbar\Util\Singleton;

class ArrayProvider implements CollectionProvider
{
    use Singleton;

    private function __construct()
    {
    }

    /**
     * {@inheritdoc}
     */
    public function map($xs, callable $valueSelector, callable $keySelector)
    {
        $result = array();
        foreach ($xs as $k => $x) {
            $key = call_user_func($keySelector, $x, $k, $xs);
            $result[$key] = call_user_func($valueSelector, $x, $k, $xs);
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function concatMap($xs, callable $selector)
    {
        $result = array();
        foreach ($xs as $k => $x) {
            foreach (call_user_func($selector, $x, $k, $xs) as $y) {
                $result[] = $y;
            }
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function filter($xs, callable $predicate)
    {
        $result = array();
        foreach ($xs as $k => $x) {
            if (call_user_func($predicate, $x, $k, $xs)) {
                $result[$k] = $x;
            }
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function sample($xs, $n)
    {
        $array = Iterators::toArray($xs);
        $result = array();

        while ($n-- > 0 && !empty($array)) {
            $key = array_rand($array);
            if ($key === null) {
                break;
            }
            $result[] = $array[$key];
            unset($array[$key]);
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function memoize($xs)
    {
        return Iterators::toArray($xs);
    }

    /**
     * {@inheritdoc}
     */
    public function initial($xs, $n)
    {
        return $n > 0
            ? array_slice(Iterators::toArray($xs), 0, -$n)
            : array();
    }

    /**
     * {@inheritdoc}
     */
    public function take($xs, $n)
    {
        return $n > 0
            ? array_slice(Iterators::toArray($xs), 0, $n)
            : array();
    }

    /**
     * {@inheritdoc}
     */
    public function takeRight($xs, $n)
    {
        return $n > 0 ? array_slice(Iterators::toArray($xs), -$n) : [];
    }

    /**
     * {@inheritdoc}
     */
    public function drop($xs, $n)
    {
        return array_slice(Iterators::toArray($xs), $n);
    }

    /**
     * {@inheritdoc}
     */
    public function takeWhile($xs, callable $predicate)
    {
        $result = array();
        foreach ($xs as $k => $x) {
            if (!call_user_func($predicate, $x, $k, $xs)) {
                break;
            }
            $result[] = $x;
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function dropWhile($xs, callable $predicate)
    {
        $result = array();
        $accepted = false;
        foreach ($xs as $k => $x) {
            if ($accepted || ($accepted = !call_user_func($predicate, $x, $k, $xs))) {
                $result[] = $x;
            }
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function flatten($xs, $shallow)
    {
        return $this->doFlatten($xs, $shallow);
    }

    private function doFlatten($xs, $shallow, &$output = array())
    {
        foreach ($xss as $xs) {
            if (Iterators::isTraversable($xs)) {
                if ($shallow) {
                    foreach ($xs as $x) {
                        $output[] = $x;
                    }
                } else {
                    $this->doFlatten($xs, $shallow, $output);
                }
            } else {
                $output[] = $xs;
            }
        }
        return $output;
    }

    /**
     * {@inheritdoc}
     */
    public function intersection($xs, $others)
    {
        $args = [Iterators::toArray($xs)];
        foreach ($others as $other) {
            $args[] = Iterators::toArray($other);
        }
        return count($args) === 1
            ? $args[0]
            : array_unique(call_user_func_array('array_intersect', $args));
    }

    /**
     * {@inheritdoc}
     */
    public function uniq($xs, callable $selector)
    {
        $set = new Set();
        $result = [];
        foreach ($xs as $k => $x) {
            if ($set->add(call_user_func($selector, $x, $k, $xs))) {
                $result[$k] = $x;
            }
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function zip($xss)
    {
        $yss = $zss = $result = array();
        $loop = true;

        foreach ($xss as $xs) {
            $yss[] = $it = Iterators::create($xs);
            $it->rewind();
            $loop = $loop && $it->valid();
            $zss[] = $it->current();
        }

        if (!empty($zss)) while ($loop) {
            $result[] = $zss;
            $zss = array();
            $loop = true;
            foreach ($yss as $ys) {
                $ys->next();
                $zss[] = $ys->current();
                $loop = $loop && $ys->valid();
            }
        }

        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function concat($xss)
    {
        $result = array();
        foreach ($xss as $xs) {
            $result = array_merge($result, Iterator::toArray($xs));
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function cycle($xs, $n)
    {
        if ($n < 0) {
            throw new \OverflowException();
        }
        $result = array();
        while ($n-- > 0) {
            foreach ($xs as $x) {
                $result[] = $x;
            }
        }
        return $result;
    }

    /**
     * {@inheritdoc}
     */
    public function range($start, $stop, $step)
    {
        $l = max(ceil(($stop - $start) / $step), 0);
        $range = array();

        for ($i = 0; $i < $l; $i++) {
            $range[] = $start;
            $start += $step;
        }

        return $range;
    }

    /**
     * {@inheritdoc}
     */
    public function repeat($value, $n)
    {
        if ($n < 0) {
            throw new \OverflowException();
        }
        return $n == 0 ? array() : array_fill(0, $n, $value);
    }

    /**
     * {@inheritdoc}
     */
    public function renum($xs)
    {
        return array_values(Iterators::toArray($xs));
    }

    /**
     * {@inheritdoc}
     */
    public function iterate($initial, callable $f)
    {
        throw new \OverflowException();
    }
}