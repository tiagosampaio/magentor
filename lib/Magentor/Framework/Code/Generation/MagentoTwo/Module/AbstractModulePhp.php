<?php

namespace Magentor\Framework\Code\Generation\MagentoTwo\Module;

use Magentor\Framework\Code\Generation\AbstractPhp;
use Magentor\Framework\Filesystem\DirectoryRegistrar;

abstract class AbstractModulePhp extends AbstractPhp
{
    
    /** @var string */
    protected $objectType;
    
    /** @var string */
    protected $vendorName;
    
    /** @var string */
    protected $moduleName;
    
    /** @var string */
    protected $moduleDirectory;
    
    
    /**
     * @return string
     */
    protected function getObjectType()
    {
        return $this->objectType;
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
}
