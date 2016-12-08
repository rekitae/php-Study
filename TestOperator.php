<?php
$data = new stdClass;

$data->threeHang = '1++' ? '2' : '0';
$data->threeHang2 = '1++' ?: '0';
$data->and = !isset($dataProvider) && $dataProvider = new stdClass ? 'set' : 'not set';
$data->and2 = !isset($dataProvider) && $dataProvider = new stdClass ? 'set' : 'not set';
$data->and3 = (!isset($dataProvider2) && $dataProvider2 = new stdClass) ? 'set' : 'not set';
$data->and4 = (!isset($dataProvider2) && $dataProvider2 = new stdClass) ? 'set' : 'not set';






print_r($data);
