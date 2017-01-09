<?php
require_once('bootstrap.php');

use rkt\Common;
use rkt\Common\F as F;

F::init();

$func = function ($n)
{
    return $n+1;
};

$sum =  function ($a, $b)
{
    return $a+$b;
};

function sumFunc($a, $b)
{
    return $a+$b;
};

$list = [1,2,3];

$res = (object)[];

//$a = [sumFunc(), sumFunc()];
//$list.map(x => x+1).reduce()

$res->a1 = array_map($func, $list);
$res->a2 = Common\map($func, $list);

$res->b1 = array_reduce($list, function($a, $b) { return F::sum($a, $b); }, 0);
$res->b2 = array_reduce($list, $sum, 0);

$res->b3 = array_reduce($list, F::$s,  0);
$res->b4 = array_reduce($list, F::$ss,  0);

$res->b5 = array_reduce($list, sumFunc,  0);
$res->b6 = array_reduce($list, 'sumFunc',  0);

//$res->b7 = array_reduce($list, F::getInstance(),  0);

$str = "i'm a boy";
$temp = array_map('trim', explode(' ', $str));
print_r($temp);

exit;

//$res->b2 = Common\reduce('sum', $list, 0);
//$res->b3 = Common\reduce('sum', $list, 1);

//$res->c1 = array_reduce($list, 'concat', 'a');
//$res->c2 = Common\reduce('concat', $list, 'a');

print_r($res);
