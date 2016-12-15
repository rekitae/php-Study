<?php
/*
 * subclass 를 사용하여 다양한 방법으로 객체 생성 (SimpleFactory 대비)
 * 단순한 경우 추상 클래스는 인터페이스의 역할을 수행
 * SOLID 의 D
 * 클래스가 아닌 추상화에 의존, SimpleFactory 또는 StaticFactory와 비교되는 점.
 * > 인터페이스 리턴
 */
abstract class FactoryMethod
{
    const CHEAP = 'cheap';
    const FAST = 'fast';

    abstract protected function createVehicle(string $type): VehicleInterface;

    public function create(string $type): VehicleInterface
    {
        $obj = $this->createVehicle($type);
        $obj->setColor('black');

        return $obj;
    }
}

class ItalianFactory extends FactoryMethod
{
    protected function createVehicle(string $type): VehicleInterface
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
            case parent::FAST:
                return new CarFerrari();
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}

class GermanFactory extends FactoryMethod
{
    protected function createVehicle(string $type): VehicleInterface
    {
        switch ($type) {
            case parent::CHEAP:
                return new Bicycle();
            case parent::FAST:
                $carMercedes = new CarMercedes();
                // we can specialize the way we want some concrete Vehicle since we know the class
                $carMercedes->addAMGTuning();

                return $carMercedes;
            default:
                throw new \InvalidArgumentException("$type is not a valid vehicle");
        }
    }
}

interface VehicleInterface
{
    public function setColor(string $rgb);
}

class CarMercedes implements VehicleInterface
{
    /**
     * @var string
     */
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }

    public function addAMGTuning()
    {
        // do additional tuning here
    }
}

class CarFerrari implements VehicleInterface
{
    /**
     * @var string
     */
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}

class Bicycle implements VehicleInterface
{
    /**
     * @var string
     */
    private $color;

    public function setColor(string $rgb)
    {
        $this->color = $rgb;
    }
}

$factory = new GermanFactory();
$result = $factory->create(FactoryMethod::CHEAP);
print_r($result);

$factory = new GermanFactory();
$result = $factory->create(FactoryMethod::FAST);
print_r($result);

$factory = new ItalianFactory();
$result = $factory->create(FactoryMethod::CHEAP);
print_r($result);

$factory = new ItalianFactory();
$result = $factory->create(FactoryMethod::FAST);
print_r($result);

//$result = (new ItalianFactory())->create('spaceship');
//print_r($result);
