<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\Container;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    /** @var PhpNamespace */
    protected $namespace;
    
    
    /**
     * @return PhpClass
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Model already exists. Cannot be created again.');
        }
    
        $builder = $this->getTemplateBuilder();
        
        $builder->addUse($this->getAbstractModelClass());
        $builder->setExtends($this->getAbstractModelClass());
        
        $this->prepareObjectMethods($builder);
        
        $this->template = $builder->build();
        
        return $this->template;
    }
    
    
    /**
     * @param \Nette\PhpGenerator\ClassType $class
     *
     * @return $this
     */
    protected function prepareObjectMethods(PhpClassBuilder $builder)
    {
        $name       = '_construct';
        $visibility = 'protected';
        $body       = '$this->_init('.$this->getResourceModelClass().');';
        
        $builder->addMethod($name, $visibility, $body);
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getAbstractModelClass()
    {
        return implode(BS, ['Magento', 'Framework', 'Model', 'AbstractModel']);
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
