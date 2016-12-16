<?php

class Service
{
    protected $logger;

    public function __construct(LoggerInterface $log)
    {
        $this->logger = $log;
    }

    public function doSomething()
    {
        // no more check "if (!is_null($this->logger))..." with the NullObject pattern
        $this->logger->log('We are in > ' . __METHOD__);
        // something to do...
    }
}

interface LoggerInterface
{
    public function log($str);
}

class PrintLogger implements LoggerInterface
{
    public function log($str)
    {
        echo $str;
    }
}

class NullLogger implements LoggerInterface
{
    public function log($str)
    {
        // do nothing
    }
}

$service = new Service(new NullLogger());
echo '[', $service->doSomething(), ']';

echo PHP_EOL;

$service = new Service(new PrintLogger());
echo '[', $service->doSomething(), ']';
