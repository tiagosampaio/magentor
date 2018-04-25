<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\Container;
use Magentor\Framework\Exception\GenericException;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    /** @var string */
    protected $modelDirectory;
    
    /** @var string */
    protected $modelName;
    
    
    /**
     * Model constructor.
     *
     * @param string $name
     * @param string $module
     * @param string $vendor
     */
    public function __construct($name, $module, $vendor)
    {
        if (!$name) {
            Container::throwGenericException('Model name cannot be empty.');
        }
        
        if (!$module) {
            Container::throwGenericException('Module name cannot be empty.');
        }
        
        if (!$vendor) {
            Container::throwGenericException('Module\'s vendor name cannot be empty.');
        }
        
        $this->setModelName($name);
        $this->setVendorName($vendor);
        $this->setModuleName($module);
    }
    
    
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
            throw new GenericException('Model already exists. Cannot be created again.');
        }
    
        $phpFile = new \Nette\PhpGenerator\PhpFile();
    
        $namespace = $phpFile->addNamespace($this->getNamespace());
        $namespace->addUse($this->getAbstractModel());
    
        /** @var \Nette\PhpGenerator\ClassType $class */
        $class = $namespace->addClass($this->getModelName());
        $class->addExtend($this->getAbstractModel());
    
        /** @var \Nette\PhpGenerator\Method $method */
        $method = $class->addMethod('_construct');
        $method->setVisibility('protected');
        $method->setBody('$this->_init(?);', ['\resourceClass']);
    
        $contents = (string) $phpFile;
        
        @file_put_contents($this->getFilePath(), $contents);
    }
    
    
    /**
     * @param $modelName
     *
     * @return $this
     */
    protected function setModelName($modelName)
    {
        $this->modelName = $modelName;
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getModelName()
    {
        return (string) $this->modelName;
    }
    
    
    /**
     * @return $this
     */
    protected function initModelDirectory($createAutomatically = true)
    {
        $this->modelDirectory = $this->getModuleDirectory() . DIRECTORY_SEPARATOR . $this->getObjectType();
        
        if (!is_dir($this->modelDirectory) && (true === $createAutomatically)) {
            mkdir($this->modelDirectory, $this->getDirectoryCreationMode(), true);
        }
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getModelDirectory()
    {
        $this->initModelDirectory();
        return realpath($this->moduleDirectory);
    }
    
    
    /**
     * @return string
     */
    protected function getFilePath()
    {
        $path  = $this->getModelDirectory() . DIRECTORY_SEPARATOR;
        $path .= $this->getObjectType() . DIRECTORY_SEPARATOR;
        $path .= $this->getModelName();
        $path .= '.' . $this->getFileExtension();
        
        return $path;
    }
    
    
    /**
     * @return string
     */
    protected function getNamespace()
    {
        return $this->getVendorName() . NS . $this->getModuleName() . NS . $this->getObjectType();
    }
    
    
    /**
     * @return string
     */
    protected function getAbstractModel()
    {
        return implode(NS, ['Magento', 'Framework', 'Model', 'AbstractModel']);
    }
}
