<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\ExceptionContainer;

class Helper extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Helper';
    
    
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
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\App\Helper\AbstractHelper";
    }
}
