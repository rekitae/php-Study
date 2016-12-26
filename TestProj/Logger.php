<?php
require_once('../vendor/autoload.php');

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

class AppLogger implements LoggerInterface
{
    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
    }

    public function debug($message, array $context = array())
    {
        print_r($message);
    }

    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }
}

class App implements LoggerAwareInterface
{
    private $logger;

    public function setLogger(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function getLogger() : LoggerInterface
    {
        return $this->logger;
    }

    public function test1()
    {
        $this->getLogger()->debug('test1 called'. PHP_EOL);
    }

    public function test2()
    {
        $this->getLogger()->debug('test2 called'. PHP_EOL);
    }

    public function test3()
    {
        $this->getLogger()->debug('test3 called'. PHP_EOL);
    }
}

$app = new App();
$app->setLogger(new AppLogger());

$app->test1();
$app->test2();
$app->test3();
