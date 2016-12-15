<?php
interface IPersist
{
	public function get($key);
	public function set($key, $value);
	public function flush();
}

class MysqlPersist implements IPersist
{
	public function get($key)
	{
		echo 'select * from persist where key = ' , $key , PHP_EOL;
	}

	public function set($key, $value)
	{
		echo 'upcert persist set value = ', $value , ' where key = ' , $key , PHP_EOL;
	}

	public function flush()
	{
		echo 'truncate table persit', PHP_EOL;
	}
}

class RedisPersist implements IPersist
{
	public function get($key)
	{
		echo 'redis get ' , $key , PHP_EOL;
	}

	public function set($key, $value)
	{
		echo 'redis set ' , $key , ' ' , $value ,  PHP_EOL;
	}

	public function flush()
	{
		echo 'not support' , PHP_EOL;
	}
}

class MemcachedPersist implements IPersist
{
	public function get($key)
	{
		echo 'memcached get ' , $key , PHP_EOL;
	}

	public function set($key, $value)
	{
		echo 'memcached set ' , $key , ' ' , $value ,  PHP_EOL;
	}

	public function flush()
	{
		echo 'not support' , PHP_EOL;
	}
}

class MemoryPersist implements IPersist
{
	private $arr;
	
	function __construct()
	{
		$this->arr = new stdClass;
	}

	public function get($key)
	{
		echo 'memory get ' , $key , PHP_EOL;
		return $this->arr->{$key} ?? null;
	}

	public function set($key, $value)
	{
		echo 'memory set ' , $key , ' ' , $value ,  PHP_EOL;
		$this->arr->{$key} = $value;
	}

	public function flush()
	{
		echo 'not support' , PHP_EOL;
	}
}

class MyApp
{
	private $id;
	private $name;
	private $age;
	private $phone;
	private $persist;

	function __construct()
	{
		//return $this;
	}

	function setId($id)
	{
		$this->id = $id;
	}

	function setData($id, $name, $age, $phone)
	{
		$this->id = $id;
		$this->name = $name;
		$this->age = $age;
		$this->phone = $phone;
	}

	function getData()
	{
		return [$this->name, $this->age, $this->phone];
	}

	public function setPersist(IPersist $persist)
	{
		$this->persist = $persist;
	}

    public function getPersist() : IPersist
    {
        return $this->persist;
    }

    public function load()
	{
		list($this->name, $this->age, $this->phone) = json_decode($this->getPersist()->get($this->id));
	}

	public function save()
	{
        $this->getPersist()->set($this->id, json_encode([$this->name, $this->age, $this->phone]));
	}
}

$mysqlPersist = new MysqlPersist();
$redisPersist = new RedisPersist();
$memcachedPersist = new MemcachedPersist();
$memoryPersist = new MemoryPersist();

echo '----------------------------------- MySQL' , PHP_EOL;
$app = new MyApp();
$app->setData('rekitae', 'kitae re', 36, '010-2673-0629');
$app->setPersist($mysqlPersist);
$app->save();
$app->load();

echo '----------------------------------- Redis' , PHP_EOL;
$app = new MyApp();
$app->setData('rekitae', 'kitae re', 36, '010-2673-0629');
$app->setPersist($redisPersist);
$app->save();
$app->load();

echo '----------------------------------- Memcached' , PHP_EOL;
$app = new MyApp();
$app->setData('rekitae', 'kitae re', 36, '010-2673-0629');
$app->setPersist($memcachedPersist);
$app->save();
$app->load();

echo '----------------------------------- Memory' , PHP_EOL;
$app = new MyApp();
$app->setData('rekitae', 'kitae re', 36, '010-2673-0629');
$app->setPersist($memoryPersist);
$app->save();

unSet($app);

echo '----------------------------------- Memory' , PHP_EOL;
$app2 = new MyApp();
$app2->setPersist($memoryPersist);
$app2->setId('rekitae');
$app2->load();

print_r($app2->getData());

