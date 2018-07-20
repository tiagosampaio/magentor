<?php

namespace Magentor\Framework\Exception;

class ExceptionContainer
{

    /** @var self */
    protected static $instance;


    protected function __construct()
    {
    }


    /**
     * @return ExceptionContainer
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
     * @param $message
     */
    public static function throwFileOverwriteException($message)
    {
        self::throwException(FileOverwriteException::class, $message);
    }


    /**
     * @param $message
     */
    public static function throwPhpVersionException($message)
    {
        self::throwException(PhpVersionException::class, $message);
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
