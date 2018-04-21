<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Magentor\Framework\Magento\FileSystem\MagentoOne as MagentoOneFileSystem;

class Bootstrap extends BootstrapAbstract
{
    
    /** @var string */
    protected $mageCode = 'admin';
    
    /** @var string */
    protected $mageType = 'store';
    
    /** @var bool */
    protected $initialized = false;
    
    
    protected function prepare()
    {
        $this->requireMageFile();
    }


    /**
     * @inheritdoc
     */
    public function initializeMagento()
    {
        if (!$this->initialized) {
            \Mage::app($this->mageCode, $this->mageType);
        }

        return true;
    }
    
    
    /**
     * @return $this
     */
    protected function requireMageFile()
    {
        if (!class_exists('Mage')) {
            $mageFile = DirectoryRegistrar::magentoBuildPath(MagentoOneFileSystem::MAGE_PATH);
            require_once $mageFile;
        }
        
        return true;
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
