<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Magentor\Framework\Magento\FileSystem\MagentoOne as MagentoOneFileSystem;

class MagentoOne extends BootstrapperAbstract
{
    
    /** @var string */
    protected $mageCode = 'admin';
    
    /** @var string */
    protected $mageType = 'store';
    
    /** @var bool */
    protected $initialized = false;
    
    
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
        try {
            $this->beforeCall(true);
            return \Mage::getStoreConfig($path, $store);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * @inheritdoc
     */
    public function getBaseUrl($secure = null)
    {
        try {
            $this->beforeCall(true);
            return \Mage::getBaseUrl('link', $secure);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }
    
    
    /**
     * @return bool
     */
    public function isInstalled()
    {
        $this->beforeCall(true);
        return (bool) \Mage::isInstalled();
    }
    
    
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
     * @return $this
     */
    protected function initializeMagento()
    {
        if (!$this->initialized) {
            \Mage::app($this->mageCode, $this->mageType);
        }
        
        return $this;
    }
    
    
    /**
     * @param bool $initializedNeeded
     *
     * @return $this
     *
     * @throws \Exception
     */
    protected function beforeCall($initializedNeeded = false)
    {
        if (true === $initializedNeeded) {
            try {
                $this->initializeMagento();
            } catch (\Exception $e) {
                throw new \Exception('Magento could not be initialized. Please check database connection.');
            }
        }
        
        return $this;
    }
}
