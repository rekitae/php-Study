<?php
declare(strict_types=1);

//////////////////////////////////////////////////

class Test__toString
{
	function __toString()
	{
		return 'this is in tostring method';
	}
}

echo '__toString : ', new Test__toString(), PHP_EOL;

//////////////////////////////////////////////////

function foo(int $arg) {
	return $arg;
}

//echo 'type hint : ', foo(1.0). PHP_EOL; // error (because strict mode)
echo 'type hint : ', foo(5), PHP_EOL; // pass

//////////////////////////////////////////////////

class TestMagicMethods
{
	public $name, $age;
	private $arr;

	function __construct(string $name, int $age)
	{
		$this->name = $name;
		$this->age = $age;

		$this->arr = new stdClass();
		echo 'set up ' , $this->name , ' with ' , $this->age , PHP_EOL;
	}

	function __destruct()
	{
		echo $this->name , ' go away' , PHP_EOL;
	}

	function __get(string $name)
	{
		echo 'request get inaccessible props : ', $name , PHP_EOL;
		return $this->arr->{$name} ?? null;
	}

	function __isset(string $name)
	{
		echo 'request isset inaccessible props : ', $name , PHP_EOL;
		return isset($this->arr->{$name});
	}

	function __set(string $name, int $value)
	{
		$this->arr->{$name} = $value;
		echo 'request set inaccessible props : ', $name , ' with ' , $value , PHP_EOL;
	}

	function __unset(string $name)
	{
		echo 'request unset inaccessible props : ', $name;

		if (isset($this->arr->{$name})) {
			echo ' Unset';
			unset($this->arr->{$name});
		} else {
			echo ' NotUnset';
		}

		echo PHP_EOL;
	}

	function __call(string $name , array $arguments)
	{
		echo 'call ' , $name , PHP_EOL;
	}

	public static function __callStatic(string $name , array $arguments)
	{
		echo 'callStatic ' , $name , PHP_EOL;
	}

	public static function Func()
	{
		echo 'this is Func function' , PHP_EOL;
	}

	public static function staticFunc()
	{
		echo 'this is staticFunc function' , PHP_EOL;
	}

	function __sleep()
	{
		echo '#sleep' , PHP_EOL;
		return array('name', 'arr');
	}

	function __wakeup()
	{
		echo '#wakeup' , PHP_EOL;
	}

	function __toString()
	{
		echo 'called toString' , PHP_EOL;
		return 'hehe';
	}

	function __debugInfo()
	{
		echo 'called debugInfo' , PHP_EOL;
		return [];
	}
}

$test = new TestMagicMethods('ktlee', 36);
echo '---------------------- set / get', PHP_EOL;
$test->weight = 80;
echo $test->weight , PHP_EOL;

echo '---------------------- isset', PHP_EOL;
echo isset($test->weight) ? 'Set' : 'NotSet' , PHP_EOL;
echo isset($test->weight2) ? 'Set' : 'NotSet' , PHP_EOL;

echo '---------------------- empty', PHP_EOL;
echo empty($test->weight) ? 'Empty' : 'NotEmpty' , PHP_EOL;
echo empty($test->weight2) ? 'Empty' : 'NotEmpty' , PHP_EOL;
$test->weight3 = 0;
echo empty($test->weight3) ? 'Empty' : 'NotEmpty' , PHP_EOL;

echo '---------------------- unset / get ', PHP_EOL;
unset($test->weight);
unset($test->weight2);
echo $test->weight;
echo $test->weight2;

echo '---------------------- Func() / Func2() ', PHP_EOL;
$test->Func();
$test->Func2();

echo '---------------------- staticFunc() / staticFunc2() ', PHP_EOL;
$test::staticFunc();
$test::staticFunc2();

echo '---------------------- set / serialize ', PHP_EOL;
$test->height = 170;
$serialize = serialize($test);
echo $serialize , PHP_EOL;

echo '---------------------- unserialize / get', PHP_EOL;
$test2 = unserialize($serialize);
print_r($test2);

echo $test->height , PHP_EOL;

echo '---------------------- toString / debugInfo', PHP_EOL;
echo $test , PHP_EOL;
var_dump($test);

echo '---------------------- unset', PHP_EOL;
unSet($test);
echo 'finish' , PHP_EOL;
?>
