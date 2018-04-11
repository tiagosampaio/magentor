<?php

namespace Magentor\Framework\Component;

interface ModuleRegistrarInterface extends ComponentRegistrarInterface
{

    const TYPE_MODULE  = 'module';


    /**
     * @param string $componentName
     * @param string $path
     */
    public static function register($componentName, $path);


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
