<?php

namespace Emonkak\Collection\Selector;

class PropertySelectorParser
{
    public static function parse($expr)
    {
        $accessor = '';
        $length = preg_match_all('/\[(\w+)\]|(?:^|(?<=.)\.)(\w+)|./', $expr, $matches);
        $arrayProps = $matches[1];
        $objectProps = $matches[2];

        for ($i = 0; $i < $length; $i++) {
            if (($prop = $arrayProps[$i]) !== '') {
                $accessor .= self::createArrayAccessor($prop);
            } elseif (($prop = $objectProps[$i]) !== '') {
                $accessor .= self::createObjectAccessor($prop);
            } else {
                throw new \InvalidArgumentException("Failed to parse '$expr'");
            }
        }

        $accessor .= 'return $v;';

        return create_function('$v', $accessor);
    }

    private static function createArrayAccessor($prop)
    {
        return "if(isset(\$v['$prop']))\$v=\$v['$prop'];else return null;";
    }

    private static function createObjectAccessor($prop)
    {
        return "if(isset(\$v->$prop))\$v=\$v->$prop;else return null;";
    }
}
