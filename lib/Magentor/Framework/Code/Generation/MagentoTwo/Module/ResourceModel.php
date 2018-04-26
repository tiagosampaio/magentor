<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Exception\Container;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

class ResourceModel extends Model
{
    
    /** @var string */
    protected $objectType = 'Model/ResourceModel';
    
    
    /**
     * @return PhpClassBuilder
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Resource Model already exists. Cannot be created again.');
        }
    
        $builder = new PhpClassBuilder();
        
        $builder->setNamespace($this->getNamespace());
        $builder->addUse($this->getAbstractModelClass());
        $builder->setClassName($this->getObjectName());
        $builder->setExtends($this->getAbstractModelClass());
        
        $this->prepareObjectMethods($builder);
        
        return $builder;
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
