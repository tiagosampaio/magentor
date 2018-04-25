<?php
namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Exception\GenericException;

class Model extends AbstractModulePhp
{
    
    /** @var string */
    protected $objectType = 'Model';
    
    /** @var string */
    protected $modelDirectory;
    
    /** @var string */
    protected $modelName;
    
    
    public function __construct($name, $module, $vendor)
    {
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
            throw new GenericException('Model already exists. Cannot create it.');
        }
    
        $phpFile = new \Nette\PhpGenerator\PhpFile();
        $abstractModel = "\Magento\Framework\Model\AbstractModel";
    
        $ns = $this->getNamespace();
        
        $namespace = $phpFile->addNamespace($ns);
        $namespace->addUse($abstractModel);
    
        /** @var \Nette\PhpGenerator\ClassType $class */
        $class = $namespace->addClass($this->getModelName());
        $class->addExtend($abstractModel);
    
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
        return $this->moduleDirectory;
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
        return $this->getVendorName() . '\\' . $this->getModuleName() . '\\' . $this->getObjectType();
    }
}
