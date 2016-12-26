<?php
require_once('../vendor/autoload.php');
// 다음을 수행해 줘야 함 : php ..\composer.phar dump-autoload -o

/*
  "autoload": {
    "psr-4": {
      "rkt\\": "TestProj/rkt"
    }
  }
*/

use rkt\File;
use rkt\Net;

//File\Reader::test();
(new File\Reader)->test();
//\File\Reader::test();
(new rkt\File\Reader)->test();

$socket = new Net\Socket;

//$socket->send('hello ?');
$socket->send('hello ?');

//echo 'recv : ', Net\Socket::recv(), PHP_EOL;
echo 'recv : ', $socket->recv(), PHP_EOL;
