<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\Container;

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
            Container::throwGenericException('Helper already exists. Cannot be created again.');
        }
    
        $builder = $this->getTemplateBuilder();
    
        $builder->addUse($this->getParentClass());
        $builder->setExtends($this->getParentClass());
    
        $this->template = $builder->build();
    
        return $this->template;
    }
    
    
    /**
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\App\Helper\AbstractHelper";
    }
}
