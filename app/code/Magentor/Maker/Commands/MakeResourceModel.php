<?php

namespace Magentor\Maker\Commands;

class MakeResourceModel extends MakeModel
{
    
    protected $name        = 'make:resource-model';
    protected $description = 'Creates a Magento resource model.';
    
    
    /**
     * @return array
     */
    protected function getOptions()
    {
        return [];
    }
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @return \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model
     */
    protected function getMaker(string $name, string $module, string $vendor)
    {
        return new \Magentor\Framework\Code\Generation\MagentoTwo\Module\Model($name, $module, $vendor);
    }
}
