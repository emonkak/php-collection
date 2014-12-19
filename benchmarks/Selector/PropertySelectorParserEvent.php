<?php

namespace Emonkak\Collection\Benchmarks\Selector;

use Athletic\AthleticEvent;
use Emonkak\Collection\Selector\PropertySelectorParser;

class PropertySelectorParserEvent extends AthleticEvent
{
    public function setUp()
    {
        $this->properySelector = PropertySelectorParser::parse('[foo]');
        $this->lambdaSelector = function($v) {
            return isset($v['foo']) ? $v['foo'] : null;
        };
    }

    /**
     * @iterations 1000
     */
    public function parse()
    {
        PropertySelectorParser::parse('[foo].bar.baz[foo].bar.baz[foo].bar.baz');
    }

    /**
     * @iterations 1000
     */
    public function properySelector()
    {
        assert('bar' === call_user_func($this->properySelector, ['foo' => 'bar']));
    }

    /**
     * @iterations 1000
     */
    public function lambdaSelector()
    {
        assert('bar' === call_user_func($this->lambdaSelector, ['foo' => 'bar']));
    }
}
