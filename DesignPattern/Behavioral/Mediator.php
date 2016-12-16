<?php

interface MediatorInterface
{
    public function makeRequest();

    public function queryDb();

    public function sendResponse($content);
}

class Mediator implements MediatorInterface
{
    protected $database;
    protected $client;
    protected $server;

    public function setColleague(Database $db, Client $cl, Server $srv)
    {
        $this->database = $db;
        $this->client = $cl;
        $this->server = $srv;
    }

    public function makeRequest()
    {
        $this->server->process();
    }

    public function queryDb()
    {
        return $this->database->getData();
    }

    public function sendResponse($content)
    {
        $this->client->output($content);
    }
}

abstract class Colleague
{
    private $mediator;

    public function __construct(MediatorInterface $medium)
    {
        // in this way, we are sure the concrete colleague knows the mediator
        $this->mediator = $medium;
    }

    // for subclasses
    protected function getMediator()
    {
        return $this->mediator;
    }
}

class Client extends Colleague
{
    public function request()
    {
        $this->getMediator()->makeRequest();
    }

    public function output($content)
    {
        echo $content;
    }
}

class Database extends Colleague
{
    public function getData()
    {
        return "World";
    }
}

class Server extends Colleague
{
    /**
     * process on server
     */
    public function process()
    {
        $data = $this->getMediator()->queryDb();
        $this->getMediator()->sendResponse("Hello $data");
    }
}

$media = new Mediator();
$client = new Client($media);
$database = new Database($media);
$server = new Server($media);

$media->setColleague($database, $client, $server);
//$media->setColleague(new Database($media), $client, new Server($media));

echo PHP_EOL, '--------------------------------- mediator', PHP_EOL;
//$client->expectOutputString('Hello World');
$media->makeRequest();
echo PHP_EOL;
echo $media->queryDb(), PHP_EOL;

echo PHP_EOL, '--------------------------------- client', PHP_EOL;
$client->request();
echo PHP_EOL;

echo PHP_EOL, '--------------------------------- database', PHP_EOL;
echo $database->getData();
echo PHP_EOL;

echo PHP_EOL, '--------------------------------- server', PHP_EOL;
$server->process();