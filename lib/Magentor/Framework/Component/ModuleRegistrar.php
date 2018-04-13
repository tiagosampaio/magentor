<?php

namespace Magentor\Framework\Component;

class ModuleRegistrar implements ModuleRegistrarInterface
{

    /** @var array */
    protected static $paths = [
        self::TYPE_MODULES => [],
    ];


    /**
     * @param string $moduleName
     * @param string $path
     */
    public static function register($moduleName, $path)
    {
        self::$paths[self::TYPE_MODULES][$moduleName] = str_replace('\\', '/', $path);
    }


    /**
     * @return array
     */
    public static function getPaths()
    {
        return self::$paths[self::TYPE_MODULES];
    }
}
