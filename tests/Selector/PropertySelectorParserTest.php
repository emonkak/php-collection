<?php

namespace Emonkak\Collection\Tests\Selector;

use Emonkak\Collection\Selector\PropertySelectorParser;

class PropertySelectorParserTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider provideParse
     */
    public function testParse($value, $expr, $expectedResult)
    {
        $accessor = PropertySelectorParser::parse($expr);
        $this->assertInternalType('callable', $accessor);
        $this->assertSame($expectedResult, call_user_func($accessor, $value));
    }

    public function provideParse()
    {
        return [
            [['Bernhard', 'Schussek'], '[0]', 'Bernhard'],
            [['Bernhard', 'Schussek'], '[1]', 'Schussek'],
            [['firstName' => 'Bernhard'], '[firstName]', 'Bernhard'],
            [['index' => ['firstName' => 'Bernhard']], '[index][firstName]', 'Bernhard'],
            [(object) ['firstName' => 'Bernhard'], 'firstName', 'Bernhard'],
            [(object) ['property' => ['firstName' => 'Bernhard']], 'property[firstName]', 'Bernhard'],
            [['index' => (object) ['firstName' => 'Bernhard']], '[index].firstName', 'Bernhard'],
            [(object) ['property' => (object) ['firstName' => 'Bernhard']], 'property.firstName', 'Bernhard'],

            // Missing indices
            [['index' => []], '[index][firstName]', null],
            [['root' => ['index' => []]], '[root][index][firstName]', null],
            [(object) ['firstName' => 'Bernhard'], 'lastName', null],
            [(object) ['property' => (object) ['firstName' => 'Bernhard']], 'property.lastName', null],
            [['index' => (object) ['firstName' => 'Bernhard']], '[index].lastName', null],
            [['firstName' => 'Bernhard'], '[lastName]', null],
            [[], '[index][lastName]', null],
            [['index' => []], '[index][lastName]', null],
            [['index' => ['firstName' => 'Bernhard']], '[index][lastName]', null],
            [(object) ['property' => ['firstName' => 'Bernhard']], 'property[lastName]', null],
        ];
    }

    /**
     * @dataProvider provideParseInvalidExpr
     * @expectedException \InvalidArgumentException
     */
    public function testParseInvalidExpr($expr)
    {
        PropertySelectorParser::parse($expr);
    }

    public function provideParseInvalidExpr()
    {
        return [
            ['[]'],
            ['[foo'],
            ['[[foo]'],
            ['[foo]]'],
            ['[foo]['],
            ['[foo].'],
            [']foo'],
            ['foo['],
            ['foo]'],
            ['.foo'],
            ['.[foo]'],
            ['foo.'],
            ['foo..bar'],
            ['!'], ['"'], ['#'], ['$'], ['%'], ['&'], ["'"], ['('], [')'], ['*'],
            ['+'], [','], ['-'], ['.'], ['/'], [':'], [';'], ['<'], ['='], ['>'],
            ['?'], ['@'], ['['], ['\\'], [']'], ['^'], ['{'], ['|'], ['}'],
            ['[!]'], ['["]'], ['[#]'], ['[$]'], ['[%]'], ['[&]'], ["'"], ['[(]'], ['[)]'], ['[*]'],
            ['[+]'], ['[,]'], ['[-]'], ['[.]'], ['[/]'], ['[:]'], ['[;]'], ['[<]'], ['[=]'], ['[>]'],
            ['[?]'], ['[@]'], ['[[]'], ['[\\]'], ['[]]'], ['[^]'], ['[{]'], ['[|]'], ['[}]']
        ];
    }
}
