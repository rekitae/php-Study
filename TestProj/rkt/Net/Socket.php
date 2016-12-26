<?php
namespace rkt\Net;

use Faker\Provider;
use Faker\Provider\Lorem;

class Socket
{
    public function send($msg)
    {
        echo 'send : ', $msg, PHP_EOL;
    }

    public function recv()
    {
        $word = Provider\Lorem::sentence();
        $word .= "\t";
        $word .= Lorem::sentence();
        return $word;
    }
}