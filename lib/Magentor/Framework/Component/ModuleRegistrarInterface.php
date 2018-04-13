<?php

namespace Magentor\Framework\Component;

interface ModuleRegistrarInterface extends ComponentRegistrarInterface
{

    const TYPE_MODULES  = 'modules';


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
    public static function getPaths();
}
