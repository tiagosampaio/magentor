<?php

namespace Magentor\Framework\Assembler\Module;

interface ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     * @param array  $options
     *
     * @return mixed
     */
    public function create(string $vendor, string $module, string $modelName, array $options = []);
}
