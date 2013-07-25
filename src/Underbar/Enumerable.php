<?php
namespace Underbar;
trait Enumerable{
function each($a){return Eager::each($this,$a);}
function map($a){return Eager::map($this,$a);}
function collect($a){return Eager::collect($this,$a);}
function reduce($a,$b){return Eager::reduce($this,$a,$b);}
function inject($a,$b){return Eager::inject($this,$a,$b);}
function foldl($a,$b){return Eager::foldl($this,$a,$b);}
function reduceRight($a,$b){return Eager::reduceRight($this,$a,$b);}
function foldr($a,$b){return Eager::foldr($this,$a,$b);}
function scanl($a,$b){return Eager::scanl($this,$a,$b);}
function scanr($a,$b){return Eager::scanr($this,$a,$b);}
function find($a){return Eager::find($this,$a);}
function detect($a){return Eager::detect($this,$a);}
function filter($a){return Eager::filter($this,$a);}
function select($a){return Eager::select($this,$a);}
function where($a){return Eager::where($this,$a);}
function findWhere($a){return Eager::findWhere($this,$a);}
function reject($a){return Eager::reject($this,$a);}
function every($a=NULL){return Eager::every($this,$a);}
function all($a=NULL){return Eager::all($this,$a);}
function some($a=NULL){return Eager::some($this,$a);}
function any($a=NULL){return Eager::any($this,$a);}
function contains($a){return Eager::contains($this,$a);}
function invoke($a,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::invoke($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function pluck($a){return Eager::pluck($this,$a);}
function max($a=NULL){return Eager::max($this,$a);}
function min($a=NULL){return Eager::min($this,$a);}
function sum(){return Eager::sum($this);}
function product(){return Eager::product($this);}
function sortBy($a){return Eager::sortBy($this,$a);}
function groupBy($a=NULL,$b=false){return Eager::groupBy($this,$a,$b);}
function countBy($a=NULL,$b=false){return Eager::countBy($this,$a,$b);}
function shuffle(){return Eager::shuffle($this);}
function toArray(){return Eager::toArray($this);}
function toList(){return Eager::toList($this);}
function memoize(){return Eager::memoize($this);}
function size(){return Eager::size($this);}
function first($a=NULL,$b=NULL){return Eager::first($this,$a,$b);}
function head($a=NULL,$b=NULL){return Eager::head($this,$a,$b);}
function take($a=NULL,$b=NULL){return Eager::take($this,$a,$b);}
function initial($a=1,$b=NULL){return Eager::initial($this,$a,$b);}
function last($a=NULL,$b=NULL){return Eager::last($this,$a,$b);}
function rest($a=1,$b=NULL){return Eager::rest($this,$a,$b);}
function tail($a=1,$b=NULL){return Eager::tail($this,$a,$b);}
function drop($a=1,$b=NULL){return Eager::drop($this,$a,$b);}
function takeWhile($a){return Eager::takeWhile($this,$a);}
function dropWhile($a){return Eager::dropWhile($this,$a);}
function compact(){return Eager::compact($this);}
function flatten($a=false){return Eager::flatten($this,$a);}
function without($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::without($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function union($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::union($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function intersection($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::intersection($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function difference($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::difference($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function uniq($a=false,$b=NULL){return Eager::uniq($this,$a,$b);}
function unique($a=false,$b=NULL){return Eager::unique($this,$a,$b);}
function zip($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::zip($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function zipWith($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::zipWith($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function unzip($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::unzip($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function span($a){return Eager::span($this,$a);}
function object($a=NULL){return Eager::object($this,$a);}
function indexOf($a,$b=0){return Eager::indexOf($this,$a,$b);}
function lastIndexOf($a,$b=NULL){return Eager::lastIndexOf($this,$a,$b);}
function sortedIndex($a,$b=NULL){return Eager::sortedIndex($this,$a,$b);}
function range($a=NULL,$b=1){return Eager::range($this,$a,$b);}
function cycle($a=NULL){return Eager::cycle($this,$a);}
function repeat($a=-1){return Eager::repeat($this,$a);}
function iterate($a){return Eager::iterate($this,$a);}
function pop(){return Eager::pop($this);}
function push($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::push($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function reverse(){return Eager::reverse($this);}
function shift(){return Eager::shift($this);}
function sort($a=NULL){return Eager::sort($this,$a);}
function splice($a,$b,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::splice($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function unshift($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::unshift($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function concat($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::concat($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function join($a=','){return Eager::join($this,$a);}
function slice($a,$b=NULL){return Eager::slice($this,$a,$b);}
function keys(){return Eager::keys($this);}
function values(){return Eager::values($this);}
function pairs(){return Eager::pairs($this);}
function invert(){return Eager::invert($this);}
function extend($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::extend($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function pick($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::pick($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function omit($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::omit($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function defaults($a=NULL,$b=NULL,$c=NULL,$d=NULL,$e=NULL,$f=NULL,$g=NULL,$h=NULL,$i=NULL,$j=NULL){return Eager::defaults($this,$a,$b,$c,$d,$e,$f,$g,$h,$i,$j);}
function tap($a){return Eager::tap($this,$a);}
function isArray(){return Eager::isArray($this);}
function isTraversable(){return Eager::isTraversable($this);}
function parMap($a,$b=NULL,$c=NULL){return Eager::parMap($this,$a,$b,$c);}
function chain(){return Eager::chain($this);}
function lazy(){return Lazy::chain($this);}
}