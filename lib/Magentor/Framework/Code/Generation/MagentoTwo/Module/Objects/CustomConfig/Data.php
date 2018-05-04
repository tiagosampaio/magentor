<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module\Objects\CustomConfig;

use Magentor\Framework\Code\Generation\MagentoTwo\Module\AbstractModulePhp;
use Magentor\Framework\Exception\ExceptionContainer;
use Nette\PhpGenerator\Method;

class Data extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model/Config';
    
    
    /**
     * @return \Magentor\Framework\Code\Template\Php\PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            ExceptionContainer::throwGenericException('Helper already exists. Cannot be created again.');
        }
        
        return parent::build();
    }
    
    
    /**
     * @return array|null
     */
    protected function getParentClass()
    {
        return ['Magento\Framework\Config\Data' => 'ConfigData'];
    }
}
