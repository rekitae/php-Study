<?php

function sum($initValue, ...$numbers)
{
	return array_reduce($numbers, function($a, $b) { return $a+$b; }, $initValue);
}

echo sum(0,1,2,3) , PHP_EOL;
echo sum(1,1,2,3,4,5) , PHP_EOL;
echo sum(2,1,2,3,4,5) , PHP_EOL;
echo sum(0,1,2,3,4,5,6,7,8,9) , PHP_EOL;

function test($a, $b, ...$c)
{
	echo PHP_EOL;
	echo sprintf('[%s][%s]', $a, $b);
	echo PHP_EOL;
	print_r($c);
	echo PHP_EOL;
}

test(1,2);
test(1,2,3,4);
test(...[2,3,4]);

echo '--------------------------------------------------' , PHP_EOL;

class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
        "lastelement2",
        "lastelement3",
    );  

    public function __construct() {
        $this->position = 0;
    }

    function rewind() {
	echo __METHOD__ , ' > ';
        $this->position = 0;
    }

    function current() {
	echo __METHOD__ , ' > ';
        return $this->array[$this->position];
    }

    function key() {
	echo __METHOD__ , PHP_EOL;
        return $this->position;
    }

    function next() {
	echo __METHOD__ , ' > ';
        ++$this->position;
    }

    function valid() {
	echo __METHOD__ , ' > ';
        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;

test(...$it);

echo '--------------------------------------------------' , PHP_EOL;

print_r(iterator_to_array($it));

