<?php
// downloading the two best technologies ever in parallel
require __DIR__.'/../vendor/autoload.php';
$loop = React\EventLoop\Factory::create();
$files = array(
    'node-v0.6.18.tar.gz' => 'http://nodejs.org/dist/v0.6.18/node-v0.6.18.tar.gz',
    'php-5.5.15.tar.gz' => 'http://it.php.net/get/php-5.5.15.tar.gz/from/this/mirror',
);

$loop->addPeriodicTimer(1, function ($timer) use (&$files) {
    if (0 === count($files)) {
        $timer->cancel();
    }
    foreach ($files as $file => $url) {
        if (file_exists($file)) {
            $mbytes = filesize($file) / (1024 * 1024);
            $formatted = number_format($mbytes, 3);
            echo "$file: $formatted MiB\n";
        } else {
            echo ".\n";
        }
    }
});

echo "This script will show the download status every 1 seconds.\n";

foreach ($files as $file => $url) {
    $readStream = fopen($url, 'r');
    $writeStream = fopen($file, 'w');
    stream_set_blocking($readStream, 0);
    stream_set_blocking($writeStream, 0);
    $read = new React\Stream\Stream($readStream, $loop);
    $write = new React\Stream\Stream($writeStream, $loop);
    $read->on('end', function () use ($file, &$files) {
        unset($files[$file]);
        echo "Finished downloading $file\n";
    });
    $read->pipe($write);
}

$loop->run();
