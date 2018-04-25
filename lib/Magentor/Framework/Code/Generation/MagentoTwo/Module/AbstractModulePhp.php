<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Generation\AbstractPhp;
use Magentor\Framework\Exception\Container;
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
    protected $moduleDirectory;
    
    
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
            Container::throwGenericException('Object name cannot be empty.');
        }
        
        if (!$module) {
            Container::throwGenericException('Module name cannot be empty.');
        }
        
        if (!$vendor) {
            Container::throwGenericException('Module\'s vendor name cannot be empty.');
        }
        
        $this->setObjectName($objectName);
        $this->setVendorName($vendor);
        $this->setModuleName($module);
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
        return $this->getObjectName() . '.' . $this->getFileExtension();
    }
    
    
    /**
     * @return $this
     */
    protected function initObjectBaseDirectory($createAutomatically = true)
    {
        $this->objectBaseDirectory = $this->getModuleDirectory() . DS . $this->getObjectType();
        
        if (!is_dir($this->objectBaseDirectory) && (true === $createAutomatically)) {
            mkdir($this->objectBaseDirectory, $this->getDirectoryCreationMode(), true);
        }
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    protected function getObjectBaseDirectory()
    {
        $this->initObjectBaseDirectory();
        return realpath($this->objectBaseDirectory);
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
     * @return string
     */
    protected function getModuleDirectory()
    {
        if (!$this->moduleDirectory) {
            $this->moduleDirectory = DirectoryRegistrar::magentoBuildModulePath(
                $this->getVendorName(), $this->getModuleName()
            );
    
            if (!is_dir($this->moduleDirectory)) {
                mkdir($this->moduleDirectory, $this->getDirectoryCreationMode(), true);
            }
        }
        
        return $this->moduleDirectory;
    }
    
    
    /**
     * @return string
     */
    protected function getNamespace()
    {
        return $this->getVendorName() . NS . $this->getModuleName() . NS . $this->getObjectType();
    }
}
