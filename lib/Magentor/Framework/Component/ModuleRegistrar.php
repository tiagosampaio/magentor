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
     * @param array  $commands
     */
    public static function register($moduleName, $path, array $commands = [])
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
