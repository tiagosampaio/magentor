<?php

namespace Magentor\Framework\Assembler\Module;

use Magentor\Framework\Code\Generation\MagentoTwo\ModuleComponentBuilder;

class SetupInstallSchema implements ModuleInterface
{
    
    /**
     * @param string $vendor
     * @param string $module
     *
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup\InstallSchema
     *
     * @throws \Magentor\Framework\Exception\GenericException
     */
    public function create(string $vendor, string $module, array $options = [])
    {
        /** @var \Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\Setup\InstallSchema $factory */
        $factory = ModuleComponentBuilder::buildSetupInstallSchema($module, $vendor);
        return $factory;
    }
}
