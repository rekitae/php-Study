<?php
/**
 * Single patterns with an abstract base class and late static bindings.
 *
 * Requires PHP 5.3+
 *
 * @author      Christopher Davis <http://christopherdavis.me>
 */
trait Singleton3
{
    /**
     * Container for the objects.
     *
     * @since   0.1
     */
    private static $registry = array();
    /**
     * Get an instance of the current, called class.
     *
     * @since   0.1
     * @access  public
     * @return  object An instance of $cls
     */
    public static function instance()
    {
        $cls = get_called_class();
        !isset(self::$registry[$cls]) && self::$registry[$cls] = new $cls;
        return self::$registry[$cls];
    }

}
class A
{
    use Singleton3;

    protected function __construct()
    {
        echo "In 1 ", get_called_class(), "\n";
    }
}
class B
{
    use Singleton3;

    protected function __construct()
    {
        echo "In 2 B\n";
    }
}
class C extends A
{

}
A::instance();
B::instance();
C::instance();
