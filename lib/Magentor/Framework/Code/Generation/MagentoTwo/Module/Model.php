<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\Container;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    
    /**
     * @return PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Model already exists. Cannot be created again.');
        }
    
        $builder = $this->getTemplateBuilder();
        
        $builder->addUse($this->getParentClass());
        $builder->setExtends($this->getParentClass());
        
        // $this->prepareObjectMethods($builder);
        
        $this->template = $builder->build();
        
        return $this->template;
    }
    
    
    /**
     * @param PhpClassBuilder $builder
     *
     * @return $this
     */
    protected function prepareObjectMethods(PhpClassBuilder $builder)
    {
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getParentClass()
    {
        return "Magento\Framework\Model\AbstractModel";
    }
    
    
    /**
     * @return string
     */
    protected function getResourceModelClass()
    {
        $resolver = $this->buildResolver([
            $this->classResolver()->getVendor(),
            $this->classResolver()->getPackage(),
            $this->getObjectType(),
            'ResourceModel',
            $this->classResolver()->getClassName()
        ]);
        
        return $resolver->getFullClassName(true, true);
    }
}
