<?php 

class Model 
{ 
    protected static $name = 'Model';

    public function find() 
    { 
        echo '1 self : ' , self::$name, PHP_EOL;
        echo '1 static : ' , static::$name, PHP_EOL;
    } 
} 

class Product extends Model
{ 
	protected static $name = 'Product';
} 

$c = new Product();
$c->find();

class Product_1 extends Model
{ 
	protected static $name = 'Product';
} 

$c = new Product_1();
$c->find();

echo '---------------------------------' , PHP_EOL;

//////////////////////////////////////////////////

class Model2
{ 
    protected static $name = 'Model2';

    public function find() 
    { 
        echo '2 self : ' , self::$name, PHP_EOL;
        echo '2 static : ' , static::$name, PHP_EOL;
    } 
} 

class Product2 extends Model2
{ 
	public function __construct() {
		parent::$name = 'Proudct2';
	}
}

$c = new Model2();
$c->find();

$c = new Product2();
$c->find();

class Product2_1 extends Model2
{ 
	public function __construct() {
		//
	}
}

$c = new Product2_1();
$c->find();

echo '---------------------------------' , PHP_EOL;

//////////////////////////////////////////////////

class Model3
{ 
    protected $name = 'Model3';

    public function find() 
    { 
        echo '3 $this : ' , $this->name, PHP_EOL;
    } 
} 

class Product3 extends Model3
{ 
} 

$c = new Product3();
$c->find();

class Product3_1 extends Model3
{ 
	protected $name = 'Product3';
} 

$c = new Product3_1();
$c->find();

class Product3_2 extends Model3
{ 
	function __construct()
	{
		$this->name = 'Product3_2';
	}
} 

$c = new Product3_2();
$c->find();

class Product3_3 extends Model3
{ 
} 

$c = new Product3_3();
$c->find();


