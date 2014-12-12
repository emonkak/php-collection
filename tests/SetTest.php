<?php

namespace Emonkak\Collection\Tests;

use Emonkak\Collection\Comparer\DelegateEqualityComparer;
use Emonkak\Collection\Set;

class SetTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->foo1 = new \StdClass();
        $this->foo1->key = 'foo';
        $this->foo2 = new \StdClass();
        $this->foo2->key = 'foo';
        $this->bar = new \StdClass();
        $this->bar->key = 'bar';
        $this->baz = new \StdClass();
        $this->baz->key = 'baz';
    }

    public function testAdd()
    {
        $set = Set::create();

        $this->assertTrue($set->add('foo'));
        $this->assertFalse($set->add('foo'));
        $this->assertTrue($set->add('bar'));
        $this->assertTrue($set->add(1));
        $this->assertTrue($set->add('1'));
        $this->assertTrue($set->add(2));
        $this->assertFalse($set->add(2));
        $this->assertTrue($set->add($this->foo1));
        $this->assertFalse($set->add($this->foo2));
        $this->assertTrue($set->add($this->bar));

        return $set;
    }

    /**
     * @depends testAdd
     */
    public function testContains(Set $set)
    {
        $this->assertTrue($set->contains('foo'));
        $this->assertTrue($set->contains('bar'));
        $this->assertFalse($set->contains('baz'));
        $this->assertTrue($set->contains(1));
        $this->assertTrue($set->contains('1'));
        $this->assertTrue($set->contains(2));
        $this->assertFalse($set->contains('2'));
        $this->assertTrue($set->contains($this->foo1));
        $this->assertTrue($set->contains($this->foo2));
        $this->assertTrue($set->contains($this->bar));
        $this->assertFalse($set->contains($this->baz));
    }

    /**
     * @depends testAdd
     */
    public function testCount(Set $set)
    {
        $this->assertCount(7, $set);
    }

    /**
     * @depends testAdd
     */
    public function testRemove(Set $set)
    {
        $set = clone $set;

        $this->assertTrue($set->remove('foo'));
        $this->assertTrue($set->remove('bar'));
        $this->assertFalse($set->remove('baz'));
        $this->assertTrue($set->remove(1));
        $this->assertTrue($set->remove('1'));
        $this->assertTrue($set->remove(2));
        $this->assertFalse($set->remove('2'));
        $this->assertTrue($set->remove($this->foo1));
        $this->assertFalse($set->remove($this->foo2));
        $this->assertTrue($set->remove($this->bar));
        $this->assertFalse($set->remove($this->baz));

        $this->assertEmpty($set);
        $this->assertEmpty(iterator_to_array($set->getIterator(), false));
    }

    /**
     * @depends testAdd
     */
    public function testGetIterator(Set $set)
    {
        $xs = iterator_to_array($set);

        $this->assertCount(count($set), $xs);
        $this->assertContainsStrict('foo', $xs);
        $this->assertContainsStrict('bar', $xs);
        $this->assertContainsStrict(1, $xs);
        $this->assertContainsStrict('1', $xs);
        $this->assertContainsStrict(2, $xs);
    }

    /**
     * @depends testAdd
     */
    public function testSource(Set $set)
    {
        $this->assertEquals($set->getIterator(), $set->getSource());
    }

    private function assertContainsStrict($needle, $haystack)
    {
        $this->assertContains($needle, $haystack, '', false, true, true);
    }
}
