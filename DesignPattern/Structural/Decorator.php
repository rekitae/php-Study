<?php
/*
 *
 */
interface RenderableInterface2
{
    public function renderData(): string;
}

class Webservice implements RenderableInterface2
{
    private $data;

    public function __construct(string $data)
    {
        $this->data = $data;
    }

    public function renderData(): string
    {
        return $this->data;
    }
}

abstract class RendererDecorator
{
    protected $wrapped;

    public function __construct(RenderableInterface2 $renderer)
    {
        $this->wrapped = $renderer;
    }
}

class XmlRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        $doc = new \DOMDocument();
        $data = $this->wrapped->renderData();
        $doc->appendChild($doc->createElement('content', $data));

        return $doc->saveXML();
    }
}

class JsonRenderer extends RendererDecorator
{
    public function renderData(): string
    {
        return json_encode($this->wrapped->renderData());
    }
}

$service = new Webservice('foobar');

$render = new JsonRenderer($service);
print_r($render->renderData());

echo PHP_EOL, '-------------------------------', PHP_EOL;

$render = new XmlRenderer($service);
print_r($render->renderData());
