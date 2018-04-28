<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;
use Magentor\Framework\Code\Generation\MagentoTwo\Module\ConfigSource as BuilderConfigSource;

class ConfigSource implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     * @param string $modelName
     *
     * @return BuilderConfigSource
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, string $helperName, array $options = [])
    {
        /** @var BuilderConfigSource $builder */
        $builder = ModuleComponentBuilder::buildConfigSource($helperName, $module, $vendor);
        return $builder;
    }
}
