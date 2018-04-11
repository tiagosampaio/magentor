<?php

namespace Magentor\Framework\Component;

interface ComponentRegistrarInterface
{

    const TYPE_MODULE = 'module';


    /**
     * @param string $type
     * @param string $componentName
     * @param string $path
     */
    public static function register($type = self::TYPE_MODULE, $componentName, $path);


    /**
     * @param string $type
     *
     * @return array
     */
    public static function getPaths($type);


    /**
     * @param $type
     */
    public static function validateType($type);
}
