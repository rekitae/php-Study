<?php
/*
 * 구체적인 클래스 지정X (그래봤자 팩토리 클래스에 지정되었음.)
 * 일반적으로 생성 된 클래스는 모두 동일한 인터페이스를 구현
 * > 클래스 리턴
 */
abstract class AbstractFactory
{
    abstract public function createText(string $content): Text;
}

class HtmlFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new HtmlText('HtmlFactory '. $content);
    }
}

class JsonFactory extends AbstractFactory
{
    public function createText(string $content): Text
    {
        return new JsonText('JsonFactory '. $content);
    }
}

class Html2Factory
{
    public function createText(string $content): Text
    {
        return new HtmlText('Html2Factory ' . $content);
    }
}

abstract class Text
{
    /**
     * @var string
     */
    private $text;

    public function __construct(string $text)
    {
        $this->text = $text;
    }

    function __toString()
    {
        return get_called_class() . ' : ' . $this->text;
    }
}

class HtmlText extends Text
{
    // do something here
}

class JsonText extends Text
{
    // do something here
}

$text = (new HtmlFactory())->createText('foobar');
echo $text , PHP_EOL;

$factory = new Html2Factory();
$text = $factory->createText('foobar');
echo $text , PHP_EOL;

$factory = new JsonFactory();
$text = $factory->createText('foobar');
echo $text , PHP_EOL;
