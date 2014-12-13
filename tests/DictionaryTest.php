<?php

namespace Emonkak\Collection\Tests;

use Emonkak\Collection\Comparer\DelegateEqualityComparer;
use Emonkak\Collection\Dictionary;

class DictionaryTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->fooKey1 = new \StdClass();
        $this->fooKey1->key = 'foo';
        $this->fooKey2 = new \StdClass();
        $this->fooKey2->key = 'foo';
        $this->barKey = new \StdClass();
        $this->barKey->key = 'bar';
        $this->bazKey = new \StdClass();
        $this->bazKey->key = 'baz';
    }

    public function testPut()
    {
        $dict = Dictionary::create();

        $this->assertNull($dict->put('foo', 'bar'));
        $this->assertSame('bar', $dict->put('foo', 'baz'));
        $this->assertNull($dict->put('hoge', 'fuga'));
        $this->assertNull($dict->put(1, 'one'));
        $this->assertNull($dict->put('1', 'one'));
        $this->assertNull($dict->put(2, 'two'));
        $this->assertNull($dict->put($this->fooKey1, 'foo1'));
        $this->assertSame('foo1', $dict->put($this->fooKey2, 'foo2'));
        $this->assertNull($dict->put($this->barKey, 'bar'));

        return $dict;
    }

    public function testPutAll()
    {
        $data = ['foo' => 'bar', 'piyo' => 'payo'];

        $dict = Dictionary::create();
        $dict->putAll($data);

        $this->assertEquals($data, $dict->toArray());
    }

    /**
     * @depends testPut
     */
    public function testGet(Dictionary $dict)
    {
        $this->assertSame('baz', $dict->get('foo'));
        $this->assertSame('fuga', $dict->get('hoge'));
        $this->assertNull($dict->get('piyo'));
        $this->assertSame('one', $dict->get(1));
        $this->assertSame('one', $dict->get('1'));
        $this->assertSame('two', $dict->get(2));
        $this->assertNull($dict->get('2'));
        $this->assertSame('foo2', $dict->get($this->fooKey1));
        $this->assertSame('foo2', $dict->get($this->fooKey2));
        $this->assertSame('bar', $dict->get($this->barKey));
        $this->assertNull($dict->get($this->bazKey));
    }

    /**
     * @depends testPut
     */
    public function testContains(Dictionary $dict)
    {
        $this->assertTrue($dict->contains('foo'));
        $this->assertTrue($dict->contains('hoge'));
        $this->assertFalse($dict->contains('piyo'));
        $this->assertTrue($dict->contains(1));
        $this->assertTrue($dict->contains('1'));
        $this->assertTrue($dict->contains(2));
        $this->assertFalse($dict->contains('2'));
        $this->assertTrue($dict->contains($this->fooKey1));
        $this->assertTrue($dict->contains($this->fooKey2));
        $this->assertTrue($dict->contains($this->barKey));
        $this->assertFalse($dict->contains($this->bazKey));
    }

    /**
     * @depends testPut
     */
    public function testCount(Dictionary $dict)
    {
        $this->assertCount(7, $dict);
    }

    /**
     * @depends testPut
     */
    public function testRemove(Dictionary $dict)
    {
        $dict = clone $dict;

        $this->assertTrue($dict->remove('foo'));
        $this->assertTrue($dict->remove('hoge'));
        $this->assertFalse($dict->remove('piyo'));
        $this->assertTrue($dict->remove(1));
        $this->assertTrue($dict->remove('1'));
        $this->assertTrue($dict->remove(2));
        $this->assertFalse($dict->remove('2'));
        $this->assertTrue($dict->remove($this->fooKey1));
        $this->assertFalse($dict->remove($this->fooKey2));
        $this->assertTrue($dict->remove($this->barKey));
        $this->assertFalse($dict->remove($this->bazKey));

        $this->assertEmpty($dict);
        $this->assertEmpty(iterator_to_array($dict->getIterator(), false));
    }

    /**
     * @depends testPut
     * @requires PHP 5.5
     */
    public function testGetIterator(Dictionary $dict)
    {
        $keys = $values = [];

        foreach ($dict as $key => $value) {
            $keys[] = $key;
            $values[] = $value;
        }

        $this->assertCount(count($dict), $keys);
        $this->assertContainsStrict('foo', $keys);
        $this->assertContainsStrict('hoge', $keys);
        $this->assertContainsStrict(1, $keys);
        $this->assertContainsStrict('1', $keys);
        $this->assertContainsStrict(2, $keys);
        $this->assertContainsObject($this->fooKey1, $keys);
        $this->assertContainsObject($this->fooKey1, $keys);
        $this->assertContainsObject($this->barKey, $keys);

        $this->assertContainsStrict('baz', $values);
        $this->assertContainsStrict('fuga', $values);
        $this->assertContainsStrict('one', $values);
        $this->assertContainsStrict('two', $values);
        $this->assertContainsStrict('foo2', $values);
        $this->assertContainsStrict('bar', $values);
    }

    public function testOffsetExists()
    {
        $dict = $this
            ->getMockBuilder('Emonkak\Collection\Dictionary')
            ->setMethods(['contains'])
            ->disableOriginalConstructor()
            ->getMock();
        $dict->expects($this->at(0))
            ->method('contains')
            ->with($this->identicalTo('one'))
            ->will($this->returnValue(true));
        $dict->expects($this->at(1))
            ->method('contains')
            ->with($this->identicalTo('two'))
            ->will($this->returnValue(false));

        $this->assertTrue(isset($dict['one']));
        $this->assertFalse(isset($dict['two']));
    }

    public function testoffsetGet()
    {
        $dict = $this
            ->getMockBuilder('Emonkak\Collection\Dictionary')
            ->setMethods(['get'])
            ->disableOriginalConstructor()
            ->getMock();
        $dict->expects($this->at(0))
            ->method('get')
            ->with($this->identicalTo('one'))
            ->will($this->returnValue(1));
        $dict->expects($this->at(1))
            ->method('get')
            ->with($this->identicalTo('two'))
            ->will($this->returnValue(2));

        $this->assertSame(1, $dict['one']);
        $this->assertSame(2, $dict['two']);
    }

    public function testoffsetSet()
    {
        $dict = $this
            ->getMockBuilder('Emonkak\Collection\Dictionary')
            ->setMethods(['put'])
            ->disableOriginalConstructor()
            ->getMock();
        $dict->expects($this->at(0))
            ->method('put')
            ->with($this->identicalTo('one'), $this->identicalTo(1));
        $dict->expects($this->at(1))
            ->method('put')
            ->with($this->identicalTo('two'), $this->identicalTo(2));

        $dict['one'] = 1;
        $dict['two'] = 2;
    }

    public function testoffsetUnset()
    {
        $dict = $this
            ->getMockBuilder('Emonkak\Collection\Dictionary')
            ->setMethods(['remove'])
            ->disableOriginalConstructor()
            ->getMock();
        $dict->expects($this->at(0))
            ->method('remove')
            ->with($this->identicalTo('one'));
        $dict->expects($this->at(1))
            ->method('remove')
            ->with($this->identicalTo('two'));

        unset($dict['one']);
        unset($dict['two']);
    }

    /**
     * @depends testPut
     */
    public function testSource(Dictionary $dict)
    {
        $this->assertEquals($dict->getIterator(), $dict->getSource());
    }

    private function assertContainsStrict($needle, $haystack)
    {
        $this->assertContains($needle, $haystack, '', false, true, true);
    }

    private function assertContainsObject($needle, $haystack)
    {
        $contains = false;
        foreach ($haystack as $element) {
            if (is_object($element) && is_object($needle)) {
                if ($element == $needle) {
                    $contains = true;
                    break;
                }
            } else {
                if ($element === $needle) {
                    $contains = true;
                    break;
                }
            }
        }
        $message = sprintf('contains %s to %s', var_export($needle, true), var_export($haystack, true));
        $this->assertTrue($contains, $message);
    }
}
