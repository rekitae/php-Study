<?php
require '../vendor/autoload.php';

use GuzzleHttp\Psr7 as gPsr;
use Riverline\MultiPartParser\Part;

$i = 0;
$nid = 2770414683173632809;
$doNotDecrypt = 1;
$uid = 1;

/*
$app = function ($request, $response) use (&$i)
{
    $i++;

    $sink = new React\Stream\BufferedSink();
    $request->pipe($sink);

    $sink->promise()->then(function ($requestBody) use ($request, $response, $i)
    {
        echo 'asdf';

        var_dump($request->getPath());
        var_dump($request->getQuery());
        //var_dump($request->getHeaders());

        parse_str($requestBody, $requestData);
        var_dump($requestData);

        $text = "This is request number $i.\n";

        $headers = array('Content-Type' => 'text/plain');
        $response->writeHead(200, $headers);
        $response->end($text);
    });
};
*/

$app = function ($request, $response) use (&$i)
{
    $i++;

    $requestBody = '';
    $headers = $request->getHeaders();
    $contentLength = (int)$headers['Content-Length'];
    $receivedData = 0;

    if ($request->expectsContinue()) {
        $response->writeContinue();
        $request->close(); //Need I close request connection?
    }

    $request->on('data', function($data)
        use ($request, $response,&$requestBody,&$receivedData,$contentLength, $i)
    {
        if ($receivedData == 0) {
            print_r($request->getPath());
            print_r($request->getQuery());
        }

        $requestBody .= $data;
        $receivedData += strlen($data);
        if ($receivedData >= $contentLength) {

            /*
             * for multipart
            $document = new Part($requestBody);

            print_r($document);
             */

            /*
             * for not multipart
             */
            parse_str($requestBody, $document);
            print_r($document); //here is our data

            $text = "This is request number $i.\n";
            $headers = array('Content-Type' => 'text/plain');
            $response->writeHead(200, $headers);
            $response->end($text);
        }
    });
};

$loop = React\EventLoop\Factory::create();
$socket = new React\Socket\Server($loop);
$http = new React\Http\Server($socket);

$http->on('request', $app);

$socket->listen(8080, '0.0.0.0');
$loop->run();

