<?php

namespace Magentor\Framework\Exception;


class Container
{

    /** @var self */
    protected static $instance;


    protected function __construct()
    {}


    /**
     * @return Container
     */
    public static function getInstance()
    {
        if (self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }


    /**
     * @param $message
     */
    public static function throwGenericException($message)
    {
        self::throwException(GenericException::class, $message);
    }


    /**
     * @param string $class
     * @param string $message
     *
     * @throws ExceptionInterface
     */
    public static function throwException($class, $message)
    {
        throw new $class($message);
    }
}
