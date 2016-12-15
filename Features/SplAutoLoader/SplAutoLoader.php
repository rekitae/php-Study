<?php

    class ClassAutoloader {
        public function __construct() {
            spl_autoload_register(array($this, 'loader'));
        }
        private function loader($className) {
            echo 'Trying to load ', $className, ' via ', __METHOD__, "()", PHP_EOL;
            include $className . '.php';
        }
    }

    new ClassAutoloader();

    $obj = new TestClass1();
    $obj = new TestClass2();

    TestClass3::test();
?>


