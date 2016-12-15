<?php
/*
 * 다양한 (시그너쳐의) 생성 메소드를 만들 수 있다.
 *  - subclass 가능
 * 정적 팩토리보다 우선시 되어 사용되어야 한다.
 */
class SimpleFactory
{
    public function createBicycle()
    {
        return new Bicycle();
    }
}

class Bicycle
{
    function __construct()
    {

    }
}

$obj = (new SimpleFactory())->createBicycle();
var_dump($obj);
