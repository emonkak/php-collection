# emonkak/collection

[![Build Status](https://travis-ci.org/emonkak/php-collection.png)](https://travis-ci.org/emonkak/php-collection)
[![Coverage Status](https://coveralls.io/repos/emonkak/php-collection/badge.png)](https://coveralls.io/r/emonkak/php-collection)

A collection library as a container for aggregation of objects.

## Requirements

- PHP 5.4 or higher
- [Composer](http://getcomposer.org/)

## Licence

MIT Licence

## Example

```php
// Take five elements from a infinite list of even numbers.
Collection::iterate(0, function($n) { return $n + 1; })
    ->filter(function($n) { return $n % 2 === 0; })
    ->take(5)
    ->each(function($n) { echo $n, PHP_EOL; });
// => 0
//    2
//    4
//    6
//    8
```
