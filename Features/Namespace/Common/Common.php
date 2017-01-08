<?php
namespace rkt\Common;

class F
{
    public static $s;
    public static $ss;

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
}
