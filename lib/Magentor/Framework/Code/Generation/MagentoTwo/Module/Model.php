<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\Container;
use Magentor\Framework\Exception\GenericException;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @throws GenericException
     */
    public function generate()
    {
        if (file_exists($this->getFilePath())) {
            Container::throwGenericException('Model already exists. Cannot be created again.');
        }
    
        $phpFile = new \Nette\PhpGenerator\PhpFile();
    
        $namespace = $phpFile->addNamespace($this->getNamespace());
        $namespace->addUse($this->getAbstractModelClass());
    
        /** @var \Nette\PhpGenerator\ClassType $class */
        $class = $namespace->addClass($this->getObjectName());
        $class->addExtend($this->getAbstractModelClass());
    
        $this->prepareObjectMethods($class);
    
        $contents = (string) $phpFile;
        
        @file_put_contents($this->getFilePath(), $contents);
    }
    
    
    /**
     * @param \Nette\PhpGenerator\ClassType $class
     *
     * @return $this
     */
    protected function prepareObjectMethods(\Nette\PhpGenerator\ClassType $class)
    {
        /** @var \Nette\PhpGenerator\Method $method */
        $method = $class->addMethod('_construct');
        $method->setVisibility('protected');
        $method->setBody('$this->_init(?);', [$this->getResourceModelClass()]);
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getFilePath()
    {
        $path  = $this->getObjectBaseDirectory() . DS;
        $path .= $this->getObjectDirectory();
        $path .= $this->getObjectFilename();
        
        return $path;
    }
    
    
    /**
     * @return string
     */
    protected function getAbstractModelClass()
    {
        return implode(NS, ['Magento', 'Framework', 'Model', 'AbstractModel']);
    }
    
    
    /**
     * @return string
     */
    protected function getResourceModelClass()
    {
        return implode(NS, [
            null,
            $this->getVendorName(),
            $this->getModuleName(),
            $this->getObjectType(),
            'Resource',
            $this->getObjectName()
        ]);
    }
}
