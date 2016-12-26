<?php
require_once('Psr4AutoloaderClass.php');
require_once('Psr4Autoload.php');

use rkt\File;
use rkt\File\Reader;

(new File\Reader)->test();
(new Reader)->test();
