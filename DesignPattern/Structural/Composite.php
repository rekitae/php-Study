<?php

interface RenderableInterface
{
    public function render(): string;
}

class Form implements RenderableInterface
{
    /**
     * @var RenderableInterface[]
     */
    private $elements;

    /**
     * runs through all elements and calls render() on them, then returns the complete representation
     * of the form.
     *
     * from the outside, one will not see this and the form will act like a single object instance
     *
     * @return string
     */
    public function render(): string
    {
        $formCode = '<form>'. PHP_EOL;

        foreach ($this->elements as $element) {
            $formCode .= $element->render();
        }

        $formCode .= '</form>'. PHP_EOL;

        return $formCode;
    }

    /**
     * @param RenderableInterface $element
     */
    public function addElement(RenderableInterface $element)
    {
        $this->elements[] = $element;
    }
}

class InputElement implements RenderableInterface
{
    public function render(): string
    {
        return '<input type="text" />'. PHP_EOL;
    }
}

class TextElement implements RenderableInterface
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    public function render(): string
    {
        return $this->text. PHP_EOL;
    }
}

$form = new Form();
$form->addElement(new TextElement('Email:'));
$form->addElement(new InputElement());

$embed = new Form();
$embed->addElement(new TextElement('Password:'));
$embed->addElement(new InputElement());

$embed2 = new Form();
$embed2->addElement(new TextElement('Password verify:'));
$embed2->addElement(new InputElement());

$embed->addElement($embed2);

$form->addElement($embed);

echo $form->render();
