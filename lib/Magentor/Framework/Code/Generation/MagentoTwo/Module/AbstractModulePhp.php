<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Builder\PhpClassBuilder;
use Magentor\Framework\Code\Generation\AbstractPhp;
use Magentor\Framework\Code\Template\Php\PhpClass;
use Magentor\Framework\Exception\ExceptionContainer;
use Magentor\Framework\Filesystem\DirectoryRegistrar;

abstract class AbstractModulePhp extends AbstractPhp
{
    
    /** @var string */
    protected $objectType;
    
    /** @var string */
    protected $objectPath;
    
    /** @var string */
    protected $objectName;
    
    /** @var string */
    protected $objectBaseDirectory;
    
    /** @var string */
    protected $vendorName;
    
    /** @var string */
    protected $moduleName;
    
    /** @var string */
    protected $classDirectory;
    
    /** @var bool */
    protected $dirAutoCreation = true;
    
    /** @var bool */
    protected $renderDoc = true;
    
    
    /**
     * Model constructor.
     *
     * @param string $name
     * @param string $module
     * @param string $vendor
     */
    public function __construct($objectName, $module, $vendor)
    {
        if (!$objectName) {
            ExceptionContainer::throwGenericException('Object name cannot be empty.');
        }
        
        if (!$module) {
            ExceptionContainer::throwGenericException('Module name cannot be empty.');
        }
        
        if (!$vendor) {
            ExceptionContainer::throwGenericException('Module\'s vendor name cannot be empty.');
        }
        
        $this->initResolver([
            $vendor,
            $module,
            $this->objectType,
            $objectName
        ]);
    
        $this->setVendorName($this->classResolver()->getVendor());
        $this->setModuleName($this->classResolver()->getPackage());
        $this->setObjectPath($this->classResolver()->getClassPath());
        $this->setObjectName($this->classResolver()->getClassName());
    }
    
    
    /**
     * @param bool $flag
     *
     * @return $this
     */
    public function setDirAutoCreation(bool $flag = true)
    {
        $this->dirAutoCreation = (bool) $flag;
        return $this;
    }
    
    
    /**
     * @return bool
     */
    public function isDirAutoCreationEnabled()
    {
        return (bool) $this->dirAutoCreation;
    }
    
    
    /**
     * @param bool $flag
     *
     * @return $this
     */
    public function setRenderDoc(bool $flag = true)
    {
        $this->renderDoc = (bool) $flag;
        return $this;
    }
    
    
    /**
     * @return PhpClass
     */
    public function build()
    {
        $builder = $this->getTemplateBuilder();
    
        if ($this->getParentClass()) {
            $builder->addUse($this->getParentClass());
            $builder->setExtends($this->getParentClass());
        }
        
        foreach ((array) $this->getInterfacesClasses() as $interface) {
            $builder->addUse($interface);
            $builder->addImplements($interface);
        }
    
        $this->template = $builder->build();
    
        return $this->template;
    }
    
    
    /**
     * @return null
     */
    protected function getParentClass()
    {
        return null;
    }
    
    
    /**
     * @return array
     */
    protected function getInterfacesClasses()
    {
        return [];
    }
    
    
    /**
     * @return PhpClassBuilder
     */
    protected function getTemplateBuilder()
    {
        $builder = new PhpClassBuilder($this->classResolver(), $this->renderDoc);
        return $builder;
    }
    
    
    /**
     * @return string
     */
    protected function getObjectType()
    {
        return $this->objectType;
    }
    
    
    /**
     * @param $objectName
     *
     * @return $this
     */
    protected function setObjectName($objectName)
    {
        $this->objectName = $objectName;
        return $this;
    }
    
    
    /**
     * @param $objectName
     *
     * @return $this
     */
    protected function setObjectPath($objectPath)
    {
        $this->objectPath = $objectPath;
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getObjectName()
    {
        return (string) $this->objectName;
    }
    
    
    /**
     * @return string
     */
    protected function getObjectPath()
    {
        return $this->objectPath;
    }
    
    
    /**
     * @return null|string
     */
    protected function getObjectDirectory()
    {
        $path = null;
    
        if ($this->getObjectPath()) {
            $path .= $this->getObjectPath() . DS;
        }
        
        return $path;
    }
    
    
    /**
     * @return string
     */
    protected function getObjectFilename()
    {
        return $this->classResolver()->getClassName() . '.' . $this->getFileExtension();
    }
    
    
    /**
     * @return string
     */
    public function getFilename()
    {
        $path  = $this->getClassDir() . DS;
        $path .= $this->getObjectFilename();
        
        return $path;
    }
    
    
    /**
     * @param string $vendor
     *
     * @return $this
     */
    protected function setVendorName($vendor)
    {
        $this->vendorName = $vendor;
        return $this;
    }
    
    
    /**
     * @param string $module
     *
     * @return $this
     */
    protected function setModuleName($module)
    {
        $this->moduleName = $module;
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getVendorName()
    {
        return $this->vendorName;
    }
    
    
    /**
     * @return string
     */
    protected function getModuleName()
    {
        return $this->moduleName;
    }
    
    
    /**
     * @param bool $createDir
     *
     * @return $this
     */
    protected function initClassDir()
    {
        if (!$this->classDirectory) {
            $this->classDirectory = DirectoryRegistrar::magentoBuildCodePath(
                $this->classResolver()->getRelativePath()
            );
            
            if ($this->isDirAutoCreationEnabled()) {
                \Magentor\Framework\Filesystem\Directory::mkDir($this->classDirectory);
            }
        }
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getClassDir()
    {
        $this->initClassDir();
        return $this->classDirectory;
    }
    
    
    /**
     * @return string
     */
    protected function getNamespace()
    {
        return $this->classResolver()->getNamespace();
    }
}
