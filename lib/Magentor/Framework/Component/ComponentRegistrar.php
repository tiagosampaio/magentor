<?php

namespace Magentor\Framework\Component;

class ComponentRegistrar implements ComponentRegistrarInterface
{

    /** @var array */
    protected static $paths = [
        self::TYPE_MODULE => []
    ];


    /**
     * @param string $type
     * @param        $componentName
     * @param        $path
     */
    public static function register($type = self::TYPE_MODULE, $componentName, $path)
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
