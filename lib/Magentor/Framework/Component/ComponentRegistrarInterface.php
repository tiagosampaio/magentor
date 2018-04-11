<?php

namespace Magentor\Framework\Component;

interface ComponentRegistrarInterface
{

    /**
     * @param string $componentName
     * @param string $path
     */
    public static function register($componentName, $path);
}
