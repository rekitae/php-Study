<?php
class A {
    public static function who() {
        echo 'its class A' , PHP_EOL;
        echo __CLASS__ , PHP_EOL;
    }
    public static function test1() {
        self::who();
    }
    public static function test2() {
        static::who(); // 늦은 정적 바인딩
    }
}

class B extends A {
    public static function who() {
        echo 'its class B' , PHP_EOL;
        echo __CLASS__ , PHP_EOL;
    }
}

B::test1();
B::test2();

//////////////////////////////////////////////////

class AA {
    private function foo() {
        echo "success!\n";
    }

    public function bar() {
	echo 'rekitae' , PHP_EOL;
	}

    public function test() {
        $this->foo();
        static::foo();
    }
}

class DD extends AA {
	public function bar()
	{
		echo 'haha', PHP_EOL;
	}
	
}

class BB extends AA {
   /* foo() 는 B로 복사됩니다, 스코프가 여전히 A에 있는 이유로 호출은 성공합니다. */
}

class CC extends DD {
    private function foo() {
	echo "qwer";
        /* 본래 메서드가 대치됩니다. 스코프는 C 가 됩니다. */
	}
	public function bar()
	{
		echo 'kkkk', PHP_EOL;
		parent::bar();
	}

    public function test2() {
	$this->bar();
	parent::bar();
	}
}

$b = new BB();
$b->test();

$c = new CC();
$c->bar();
$c->test2();

$c->test();

//////////////////////////////////////////////////


