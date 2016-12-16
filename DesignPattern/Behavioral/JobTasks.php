<?php

class JobTasks
{
    protected $queue;

    function __construct()
    {
        $this->queue = [];
    }

    function append(Callable $c, ...$argv)
    {
        echo 'append : ', gettype($c), ', is_callable : ' , is_callable($c), PHP_EOL;
        $this->queue[] = [$c, $argv];
    }

    function run()
    {
        foreach ($this->queue as $node) {
            call_user_func($node[0], $node[1]);
        }
    }
}

function echoClosureWrapper(string $str) : Closure
{
    return
        function() use ($str)
        {
            echo $str, PHP_EOL;
        };
}

function echoWrap(...$argv)
{
    print_r($argv);
    echo PHP_EOL;
}

$echoTasks = new JobTasks();
$echoTasks->append(function() { echo '1111', PHP_EOL; sleep(1); });
$echoTasks->append(echoClosureWrapper('2222'));
$echoTasks->append(echoClosureWrapper('3333'));
$echoTasks->append('print_r', '4', '44', '444', '4444');
$echoTasks->run();
