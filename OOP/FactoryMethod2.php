<?php

class A {
    public static function create1() {
        $class = get_class();

        echo '__CLASS__ : ' , __CLASS__ , PHP_EOL;
        echo 'get_class : ' , $class , PHP_EOL;

        return new $class();
    }

    public static function create2() {
        return new static();
    }

	public function test() {
		echo 'test' , PHP_EOL;
	}
}

$a = A::create1();
$a->test();

$b = A::create2();
$b->test();

$c = new A;
$c->test();

var_dump($a, $b, $c);

