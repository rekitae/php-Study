<?php
$map = [
	0 => [1,1,1,1],
	1 => [2,2,2,2],
	2 => [3,3,3,3],
	3 => [4,4,4,4],
];

function encode($str)
{
	global $map;

	$mapIndex = rand(0,3);
	$gabage = rand(0,128);

	$mapGroup = $map[$mapIndex];

	$output = $mapIndex . $gabage;

	for($i = 0; $i < strlen($str); $i++)
	{
		$k = $mapGroup[($i+1)%count($mapGroup)];

		echo $str[$i] ,  ' : ', ord($str[$i]) , ' : ', ord($str[$i])+$k, ' : ' , chr(ord($str[$i])+$k);
		echo PHP_EOL;

		$output .= chr(ord($str[$i])+$k);
	}

	return $output;
}

function decode($str)
{
	global $map;

	$mapIndex = substr($str, 0, 1);
	$str = substr($str, 3);

	$mapGroup = $map[$mapIndex];

	$output = '';

	for($i = 0; $i < strlen($str); $i++)
	{
		$k = $mapGroup[($i+1)%count($mapGroup)];

		echo $str[$i] ,  ' : ', ord($str[$i]) , ' : ', ord($str[$i])-$k, ' : ' , chr(ord($str[$i])-$k);
		echo PHP_EOL;

		$output .= chr(ord($str[$i])-$k);
	}

	return $output;
}

$input = 'sw1626';
$encode = encode($input);
echo $encode , PHP_EOL;
echo '-------------------', PHP_EOL;
$decode = decode($encode);
echo '-------------------', PHP_EOL;
echo $decode , PHP_EOL;
?>
