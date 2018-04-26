<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\Container;
use Magentor\Framework\Exception\GenericException;
use Magentor\Framework\Filesystem\Io;
use Nette\PhpGenerator\ClassType;
use Nette\PhpGenerator\PhpFile;
use Nette\PhpGenerator\PhpNamespace;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    /** @var PhpNamespace */
    protected $namespace;
    
    /** @var ClassType */
    protected $class;
    
    /** @var PhpFile */
    protected $file;
    
    
    /**
     * @param string $name
     * @param string $module
     * @param string $vendor
     *
     * @throws GenericException
     */
    public function build()
    {
        if (file_exists($this->getFilename())) {
            Container::throwGenericException('Model already exists. Cannot be created again.');
        }
    
        $this->file = new \Nette\PhpGenerator\PhpFile();
    
        $this->namespace = $this->file->addNamespace($this->getNamespace());
        $this->namespace->addUse($this->getAbstractModelClass());
    
        /** @var \Nette\PhpGenerator\ClassType $class */
        $this->class = $this->namespace->addClass($this->getObjectName());
        $this->class->addExtend($this->getAbstractModelClass());
    
        $this->prepareObjectMethods($this->class);
        
        return $this->file;
    
        $contents = (string) $phpFile;
        
        $io = new Io();
        $io->write($this->getFilePath(), $contents);
    }
    
    
    /**
     * @return PhpNamespace
     */
    public function getFileContentNamespace()
    {
        return $this->namespace;
    }
    
    
    /**
     * @return ClassType
     */
    public function getFileContentClass()
    {
        return $this->class;
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
        $method->setBody('$this->_init('.$this->getResourceModelClass().');');
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getFilename()
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
            $this->getObjectName() . '::class'
        ]);
    }
}
