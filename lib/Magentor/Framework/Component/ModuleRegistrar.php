<?php

namespace Magentor\Framework\Component;

class ModuleRegistrar implements ModuleRegistrarInterface
{

    /** @var array */
    protected static $paths = [
        self::TYPE_MODULE  => [],
    ];


    /**
     * @param string $componentName
     * @param string $path
     */
    public static function register($componentName, $path)
    {
        self::validateType($type);
        self::$paths[$type][$componentName] = str_replace('\\', '/', $path);
    }


    /**
     * @param string $type
     *
     * @return array
     */
    public static function getPaths($type)
    {
        self::validateType($type);
        return self::$paths[$type];
    }


    /**
     * @param $type
     */
    public static function validateType($type)
    {
        if (!isset(self::$paths[$type])) {
            throw new \LogicException("Component type {$type} is not valid.");
        }
    }
}
