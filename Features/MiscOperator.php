<?php
$data = new stdClass;

$data->threeHang = '1++' ? '2' : '0';
$data->threeHang2 = '1++' ?: '0';
$data->and = !isset($dataProvider) && $dataProvider = new stdClass ? 'set' : 'not set';
$data->and2 = !isset($dataProvider) && $dataProvider = new stdClass ? 'set' : 'not set';
$data->and3 = (!isset($dataProvider2) && $dataProvider2 = new stdClass) ? 'set' : 'not set';
$data->and4 = (!isset($dataProvider2) && $dataProvider2 = new stdClass) ? 'set' : 'not set';



print_r($data);

$data2 = new stdClass;

$data2->stdclass1 = spl_object_hash(new stdClass());
$data2->stdclass2 = spl_object_hash(new stdClass());
$data2->stdclass3 = new stdClass();
$data2->stdclass3_1 = spl_object_hash($data2->stdclass3);
$data2->stdclass3->test = 'qwer';
$data2->stdclass3_2 = spl_object_hash($data2->stdclass3);

$data2->StringReverseWorker1 = spl_object_hash(new StringReverseWorker());
$data2->StringReverseWorker2 = spl_object_hash(new StringReverseWorker());
var_dump($data2);



class StringReverseWorker
{
    /**
     * @var \DateTime
     */
    private $createdAt;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    public function run(string $text)
    {
        return strrev($text);
    }
}
