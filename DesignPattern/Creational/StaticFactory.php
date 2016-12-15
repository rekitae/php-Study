<?php
/*
 * 추상 팩토리 패턴과 다른 점은 단 하나의 정적 메소드를 통해서 모든 유형의 객체를 생성한다는 것.
 */
class StaticFactory
{
    public static function create(string $type) : Format
    {
        switch ($type) {
            case 'string':
                return new StringFormat();
            case 'number':
                return new NumberFormat();
            default:
                throw new Exception('unknow type');
        }
    }
}

interface Format
{

}

class StringFormat implements Format
{
    function __construct()
    {

    }
}

class NumberFormat implements Format
{
    function __construct()
    {

    }
}

$obj1 = StaticFactory::create('string');
var_dump($obj1);

$obj2 = StaticFactory::create('number');
var_dump($obj2);

$obj3 = StaticFactory::create('object');
var_dump($obj3);
