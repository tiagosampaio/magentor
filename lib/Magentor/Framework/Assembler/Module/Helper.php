<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;

class Helper implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     *
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\Helper
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, string $controllerName, array $options = [])
    {
        /** @var \Magentor\Framework\Code\Generation\MagentoTwo\Module\Helper $builder */
        $builder = ModuleComponentBuilder::buildHelper($controllerName, $module, $vendor);
        return $builder;
    }
}
