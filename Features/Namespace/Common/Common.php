<?php
namespace rkt\Common;

class F
{
    private $cached;

    public static $instance;
    public static $s;
    public static $ss;

    function __construct()
    {
        $this->cached = new \stdClass;
    }

/*
    function __get(string $name)
    {
        if ($this->{$name})
        {
            return;
        }

        $func = function() { };

        if (function_exists($name))
        {
            $func = function()
            {
                return function()
                call_user_func($name, func_get_args());
            }

        }

        return $func;
    }
*/

    public static function getInstance()
    {
        if (!isset(self::$instance))
            self::$instance = new self;

        return self::$instance;
    }

    public static function init()
    {
        self::$s = function($a, $b)
        {
            return $a+$b;
        };

        self::$ss = (function()
            {
                return function ($a, $b)
                    {
                        return $a+$b;
                    };
            })();
    }

    public static function map($callable, $list)
    {
        return array_map($callable, $list);
    }

    public static function reduce($callable, $list, $init = null)
    {
        return array_reduce($list, $callable, $init);
    }

    public static function sum($a, $b)
    {
        return $a+$b;
    }

    public static function concat($a, $b)
    {
        return $a . $b;
    }

    public function sumInstance($a, $b)
    {
        return $a+$b;
    }
}

function map($callable, $list)
{
    return array_map($callable, $list);
}
