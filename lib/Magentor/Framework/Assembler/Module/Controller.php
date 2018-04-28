<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;

class Controller implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     *
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\Controller
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, string $controllerName, array $options = [])
    {
        /** @var \Magentor\Framework\Code\Generation\MagentoTwo\Module\Controller $builder */
        $builder = ModuleComponentBuilder::buildController($controllerName, $module, $vendor);
        return $builder;
    }
}
