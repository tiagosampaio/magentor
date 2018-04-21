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
    public function throwGenericException($message)
    {
        $this->throwException(GenericException::class, $message);
    }


    /**
     * @param string $class
     * @param string $message
     *
     * @throws ExceptionInterface
     */
    public function throwException($class, $message)
    {
        throw new $class($message);
    }
}
