<?php

abstract class A {
    static function create(){
        //return new self();  //Fatal error: Cannot instantiate abstract class A
        return new static(); //this is the correct way
    }

	public function test()
	{
		echo 'test' , PHP_EOL;
	}
}

class B extends A{
	public $name = 'Test';
	public function test2()
	{
		echo 'test2' , PHP_EOL;
		$this->name = 'Tested';
	}

}

$obj = B::create();
$obj->test();
$obj->test2();
var_dump($obj);

echo '--------------------------------------------------' , PHP_EOL;

$obj2 = B::create();
var_dump($obj2);
$obj2->test();
$obj2->test2();
