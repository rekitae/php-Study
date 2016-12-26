<?php
// instantiate the loader
$loader = new Psr4AutoloaderClass;

// register the autoloader
$loader->register();

// register the base directories for the namespace prefix
$loader->addNamespace('rkt', './rkt');

/*
    // register the base directories for the namespace prefix
    $loader->addNamespace('Foo\Bar', '/path/to/packages/foo-bar/src');
*/
