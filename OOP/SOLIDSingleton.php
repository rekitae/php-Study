<?php
trait Singleton
{
    protected static $instance;
    protected static $static_count = 0;
    protected $count = 0;

    final public static function getInstance($option = null)
    {
        return isset(static::$instance)
            ? static::$instance
            : static::$instance = new static($option);
    }

    // 단일 책임 원칙 위반
/*
    final public static function create($option = null)
    {
        return new static($option);
    }
*/

    final public function status()
    {
        echo '[', self::$static_count, ']', ' - [', $this->count, ']';
    }
}

trait Util
{
	function objectFilterKV() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}
}

// 영속계층으로써 제공해야되는 기능
interface IPersist2
{
    protected function __construct($shardKey = 0)
    {
        // 샤드키로 접속 종단 구분?
    }

	function load();

	function persist();

	function flush();
}

// 레디스 영속 계층 구현
class RedisPersist2 implements IPersist2
{
	protected function __construct($shardKey = 0)
	{
		// 샤드키로 접속 종단 구분?
	}

	function connect() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function load() {
		echo __CLASS__, ':', __function__, PHP_EOL;
        return __function__;
    }

	function persist() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function flush() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function __toString() {
		echo  __CLASS__, ':', __function__, PHP_EOL;
		return __function__;
	}
}

// 맴캐시 영속 계층 구현
class MemcachePersist2 implements IPersist2
{
    protected function __construct()
    {
        // 샤드키로 접속 종단 구분?
    }

    function connect() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function load() {
		echo __CLASS__, ':', __function__, PHP_EOL;
        return __function__;
	}

	function persist() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function flush() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function __toString() {
		echo  __CLASS__, ':', __function__, PHP_EOL;
		return __function__;
	}
}
/*
class PersistFactory
{
    function create()
    {
        return new RedisPersist2;
    }

    function getInstance()
    {

    }

    // 싱글톤?
}
*/

// 모델로써 제공해야되는 기능
interface IModel
{
	// 신규
	// 수정
	// 업설트
	// 삭제
	// 조회

    //function findAll();
    function findList();
    function find();

/*
	function find() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}

	function findList() {
		echo __CLASS__, ':', __function__, PHP_EOL;
	}
*/
}

// 레디스 모델 구현
abstract class RedisModel implements IModel
{
	protected $persist = null;

	//abstract function __construct(IPersist2 $persist);
	//abstract static function create(IPersist2 $persist);

	protected function __construct(RedisPersist2 $persist)
	{
		$this->persist = $persist;
	}

	function getInstance2() : RedisPersist2
    {
        return $this->persist;
    }

/*
	function setPersist(RedisPersist $persist) {
		$this->persist = $persist;
	}
*/

	function find() {
		echo __CLASS__, ':', __function__, PHP_EOL;
		echo $this->persist , PHP_EOL;
		echo $this->getInstance2()->load();
	}

	function findList() {
		echo __CLASS__, ':', __function__, PHP_EOL;
		echo $this->persist , PHP_EOL;
		echo $this->getInstance2()->load();
		return __function__;
	}
}

class Product5 extends RedisModel
{
	use Util;
	use Singleton;
	public static $static_count = 0;
	public $count = 0;

	function __construct()
	{
		$redisShardKey = '1';
		//parent::__construct(new RedisPersist2($redisShardKey));
        parent::__construct(new RedisPersist2($redisShardKey));
	}

/*
	function __construct(IPersist2 $persist)
	{
		parent::setPersist($persist);
	}

	public static function create(IPersist2 $persist)
	{
		return new static($persist);
	}
*/

	public function findCompletedList()
	{
		echo PHP_EOL, ++self::$static_count , ' : ' , ++$this->count, PHP_EOL,
		$this->findList();
	}
}

//$product = Product::create(new RedisPersist);

$product = Product5::getInstance();
$product->findCompletedList();
$product->findCompletedList();
echo '--------------------------------------------------' , PHP_EOL;

class Test
{
	public static function func()
	{
		$product = Product5::getInstance();
		$product->findCompletedList();
	}
}

Test::func();

echo '--------------------------------------------------' , PHP_EOL;

$product2 = new Product5();
$product2->findCompletedList();
$product2->findCompletedList();

echo '--------------------------------------------------' , PHP_EOL;

class Test2
{
	public static function func()
	{
		$product = new Product5();
		$product->findCompletedList();
	}
}

Test2::func();
Test2::func();

