<?php

class myIterator implements Iterator {
    private $position = 0;
    private $array = array(
        "firstelement",
        "secondelement",
        "lastelement",
    );  

    public function __construct() {
        $this->position = 0;
    }

    function rewind() {
        //var_dump(__METHOD__);
        $this->position = 0;
    }

    function current() {
        //var_dump(__METHOD__);
        return $this->array[$this->position];
    }

    function key() {
        //var_dump(__METHOD__);
        return $this->position;
    }

    function next() {
        //var_dump(__METHOD__);
        ++$this->position;
    }

    function valid() {
        //var_dump(__METHOD__);
        return isset($this->array[$this->position]);
    }
}

$it = new myIterator;

foreach($it as $key => $value) {
    var_dump($key, $value);
    echo "\n";
}

echo '--------------------------------------------------' , PHP_EOL;

function foo(): iterable {
    return [1, 2, 3];
}

function bar(iterable $iter)
{
	if ($iter instanceof Traversable)
	{
		echo 'Traverable interface', PHP_EOL;
	} else {
		echo 'Not Traverable interface', PHP_EOL;
	}

	if ($iter instanceof Iterator)
	{
		echo 'Iterator interface', PHP_EOL;
	} else {
		echo 'Not Iterator interface', PHP_EOL;
	}

	foreach ($iter as $i)
	{
		echo $i , ', ';
	}
	echo PHP_EOL;

	$iter_array = $iter instanceof Traversable ? iterator_to_array($iter) : $iter;

	array_map(function($i) { echo $i , ', '; }, $iter_array);
	echo PHP_EOL;

    $ret = array_reduce(array_map(function($i) { return is_numeric($i) ? $i+1 : $i; }, $iter_array), function ($a, $b) { return is_numeric($b) ? (int)$a+(int)$b : $a. ', '. $b; }, '');
    echo $ret , PHP_EOL;
}

bar(foo());
echo '--------------------', PHP_EOL;
bar(new myIterator);

echo '--------------------------------------------------' , PHP_EOL;

function bar2(iterable $iter)
{
	foreach ($iter as $i)
	{
		echo $i , ', ';
	}
	echo PHP_EOL;
}

function bar3(iterable $iter)
{
	foreach ($iter as $i)
	{
		echo $i , ', ';
	}
	echo PHP_EOL;
}

function bar4(iterable $iter)
{
	array_map(function($i) { echo $i , ', '; }, iterator_to_array($iter));
	echo PHP_EOL;
}
	
function from() {
    yield 4; // key 0
    yield 5; // key 1
    yield 6; // key 2
}

function gen() {
    yield 1;
    yield from from(); // keys 4-6
    yield 2; yield 3;
}

bar2(gen());
bar3(gen());
bar4(gen()); // <= Malfunction

