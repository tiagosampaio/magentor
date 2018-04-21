<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Magentor\Framework\Magento\FileSystem\MagentoOne as MagentoOneFileSystem;

class MagentoOne extends BootstrapperAbstract
{
    
    protected function prepare()
    {
        $this->requireMageFile();
    }
    
    
    /**
     * @return $this
     */
    protected function requireMageFile()
    {
        $mageFile = DirectoryRegistrar::magentoBuildPath(MagentoOneFileSystem::MAGE_PATH);
        require_once $mageFile;
        
        return $this;
    }
    
    
    /**
     * @return string
     */
    public function getVersion()
    {
        return \Mage::getVersion();
    }
    
    
    /**
     * @return string
     */
    public function getEdition()
    {
        return \Mage::getEdition();
    }
    
    
    /**
     * @return string
     */
    public function getEditionInfo()
    {
        return \Mage::getEditionInfo();
    }
    
    
    /**
     * @return string
     */
    public function getBaseDir()
    {
        return \Mage::getBaseDir();
    }
    
    
    /**
     * @return string
     */
    public function getModuleDir()
    {
        return \Mage::getModuleDir();
    }
    
    
    /**
     * @param string   $path
     * @param int|null $store
     *
     * @return string
     */
    public function getStoreConfig($path, $store = null)
    {
        return \Mage::getStoreConfig($path, $store);
    }
    
    
    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return \Mage::getBaseUrl();
    }
    
    
    /**
     * @return bool
     */
    public function isInstalled()
    {
        return (bool) \Mage::isInstalled();
    }
}
