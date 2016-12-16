<?php

interface FlyweightInterface
{
    public function render(string $extrinsicState): string;
}

class CharacterFlyweight implements FlyweightInterface
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function render(string $font): string
    {
        return sprintf('Character %s with font %s', $this->name, $font);
    }
}

class FlyweightFactory implements Countable
{
    private $pool = [];

    public function get(string $name): CharacterFlyweight
    {
        if (!isset($this->pool[$name])) {
            $this->pool[$name] = new CharacterFlyweight($name);
        }

        return $this->pool[$name];
    }

    public function count(): int
    {
        return count($this->pool);
    }
}

$characters = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'];
$fonts = ['Arial', 'Times New Roman', 'Verdana', 'Helvetica'];

$factory = new FlyweightFactory();

foreach ($characters as $char) {
    $flyweight = $factory->get($char);
    foreach ($fonts as $font) {
        // 상위 블록으로 옮김.
        //$flyweight = $factory->get($char);
        $rendered = $flyweight->render($font);
        echo $rendered, PHP_EOL;
    }
}
