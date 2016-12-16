<?php
/*
 * CommandInterface 구현체들은 결과를 리시버에 전송한다.
 * Command 와 Receiver 는 커플
 * Invoker 는 Command 를 캡슐
\ */

interface CommandInterface
{
    public function execute();
}

class HelloCommand implements CommandInterface
{
    private $output;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute($option = null)
    {
        // sometimes, there is no receiver and this is the command which does all the work
        $this->output->write('Hello World');
    }
}

class EchoCommand implements CommandInterface
{
    private $output;

    public function __construct(Receiver $console)
    {
        $this->output = $console;
    }

    public function execute($option = null)
    {
        // sometimes, there is no receiver and this is the command which does all the work
        $this->output->write($option);
    }
}

class Receiver
{
    private $enableDate = false;

    private $output = [];

    public function write(string $str)
    {
        if ($this->enableDate) {
            $str .= ' [' . date('Y-m-d') . ']';
        }

        $this->output[] = $str;
    }

    public function getOutput(): string
    {
        return join("\n", $this->output);
    }

    public function enableDate()
    {
        $this->enableDate = true;
    }

    public function disableDate()
    {
        $this->enableDate = false;
    }
}

class Invoker
{
    private $command;

    public function setCommand(CommandInterface $cmd)
    {
        $this->command = $cmd;
    }

    public function run($option = null)
    {
        $this->command->execute($option);
    }
}

$receiver = new Receiver();
$invoker = new Invoker();

$helloCommand = new HelloCommand($receiver);
$echoCommand = new EchoCommand($receiver);

$invoker->setCommand($helloCommand);
$invoker->run();

$invoker->setCommand($echoCommand);
$invoker->run('say');
$invoker->run('hello');
$invoker->run('hello1');
$invoker->run('hello2');
$invoker->run('hello3');

echo $receiver->getOutput(), PHP_EOL;

