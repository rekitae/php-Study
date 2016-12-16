<?php

class Disc implements Countable
{
    private $data;

    function __construct()
    {
        $this->data = [];
    }

    public function add(string $diskTitle)
    {
        $this->data[] = $diskTitle;
    }

    public function count()
    {
        return count($this->data);
    }

    public function __debugInfo()
    {
        return $this->data;
    }
}

$disc = new Disc();
$disc->add('ktlee');
$disc->add('sw1626');

if (count($disc) == 1) {
    echo 'disk is 1', PHP_EOL;
} elseif (count($disc) == 2) {
    echo 'disk is 2', PHP_EOL;
} else {
    echo 'disk more than 2', PHP_EOL;
}

echo count($disc) , PHP_EOL;
var_dump($disc);