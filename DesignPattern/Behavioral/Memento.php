<?php

class Memento
{
    private $state;

    public function __construct($state)
    {
        $this->state = $state;
    }

    public function getState()
    {
        return $this->state;
    }
}

class Originator
{
    private $state;

    public function setState($state)
    {
        $this->state = $state;
    }

    public function saveToMemento()
    {
        $state = is_object($this->state) ? clone $this->state : $this->state;

        return new Memento($state);
    }

    public function restoreFromMemento(Memento $memento)
    {
        $this->state = $memento->getState();
    }

    function __debugInfo()
    {
        return [
            'state' => $this->state
            ];
    }
}

$thing = new Originator();

$thing->setState(1111);
var_dump($thing);

$thing->setState(2222);
var_dump($thing);
$savedMemento = $thing->saveToMemento();

$thing->setState(3333);
var_dump($thing);

$thing->restoreFromMemento($savedMemento);
var_dump($thing);

echo '---------------------------------------', PHP_EOL;

$foo = new \stdClass();
$foo->data = "foo";

$thing->setState($foo);
var_dump($thing);
$savedMemento = $thing->saveToMemento();

$bar = new \stdClass();
$bar->data = "bar";

$thing->setState($bar);
var_dump($thing);

$thing->restoreFromMemento($savedMemento);
var_dump($thing);
