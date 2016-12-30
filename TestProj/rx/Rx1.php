<?php
include('../../vendor/autoload.php');

class DataClass
{
    private $data;

    function __construct()
    {
       //$this->data = new stdClass();
    }

    public function setData($data)
    {
        //apc_store(self::dataKey, json_encode(['a','b','c','d','e','f','g','h']));
        $this->data = $data;
    }

    public function getDataByArray()
    {
        //return json_decode(apc_fetch(self::dataKey));
        return json_decode($this->data);
    }

    public function getDataByIterator()
    {
        //return new JsonSchema\Iterator\ObjectIterator(apc_fetch(self::dataKey));
        return new JsonSchema\Iterator\ObjectIterator(json_decode($this->data));
    }
}

function asString($value) {
    if (is_array($value)) {
        return json_encode($value);
    }
    return (string) $value;
}

$createStdoutObserver = function ($prefix = '') {
    return new Rx\Observer\CallbackObserver(
        function ($value) use ($prefix) { echo $prefix . "Next value: " . asString($value) . "\n"; },
        function ($error) use ($prefix) { echo $prefix . "Exception: " . $error->getMessage() . "\n"; },
        function ()       use ($prefix) { echo $prefix . "Complete!\n"; }
    );
};

$stdoutObserver = $createStdoutObserver();

//////////////////////////////////////////////////

// A 결과와 B 결과를 가지고 C 를 실행 하는데
// A B 는 동시성을 가진다.

//////////////////////////////////////////////////

$data = new DataClass();
$data->setData(json_encode(['a','b','c','d','e','f','g','h']));


$source1 = Rx\Observable::fromArray([1,2,3,4,5]);
$source1->subscribe($stdoutObserver);

sleep(1);

$source2 = Rx\Observable::fromArray($data->getDataByArray());
$source2->subscribe($stdoutObserver);

echo 'done';
