<?php

$numArr = [1, 2, 3, 4, 5];

$list = [
	['name' => 'rekitae', 'age' => 36, 'birth' => 1981],
	['name' => 'sw1626', 'age' => 35, 'birth' => 1981],
	['name' => 'jasonkim', 'age' => 36, 'birth' => 1982],
];

foreach ($list as $node)
{
	list('name' => $name, 'age' => $age, 'birth' => $birth) = $node;

	echo 'name : ', $name, "\t\t";
	echo 'age : ', $age, "\t\t";
	echo 'birth : ', $birth, PHP_EOL;
}

echo '--------------------------------------------------' , PHP_EOL;

foreach ($list as ['name' => $name, 'age' => $age, 'birth' => $birth])
{
	echo 'name : ', $name, "\t\t";
	echo 'age : ', $age, "\t\t";
	echo 'birth : ', $birth, PHP_EOL;
}

echo '--------------------------------------------------' , PHP_EOL;

$a = 10;
$b = 20;

[$a, $b] = [$b, $a];

echo $a , ' : ' , $b , PHP_EOL;

echo '--------------------------------------------------' , PHP_EOL;

/*
[$a, $b, ... $c] = $numArr; // fails
echo $a , ' : ' , $b , PHP_EOL;
print_r($c);
*/

function f1($a, $b, ... $c)
{
	return [$a, $b, $c];
}

function output($a, $b, $c)
{
	echo $a , ' : ' , $b , PHP_EOL;
	print_r($c);
	echo PHP_EOL;
}

[$a, $b, $c] = call_user_func_array('f1', $numArr);
output($a, $b, $c);

[$a, $b, $c] = f1(...$numArr);
output($a, $b, $c);

echo '--------------------------------------------------' , PHP_EOL;

function foo(): iterable {
    return [1, 2, 3, 4];
}

[$a, $b, $c] = f1(...foo());
output($a, $b, $c);

[$a, $b, $c] = f1(...[1, 2, 3, 4]);
output($a, $b, $c);

[$a, $b, $c] = f1(...[1, 2, 3, 4]);
output($a, $b, $c);

