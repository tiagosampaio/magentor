<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Magentor\Framework\Magento\FileSystem\MagentoOne as MagentoOneFileSystem;
use Magentor\Framework\Magento\FileSystem\MagentoTwo;

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
     * @return bool
     */
    protected function requireMageFile()
    {
        if ($this->magento->getInfo()->isMagentoOne()) {
            if (!class_exists('Mage')) {
                $mageFile = DirectoryRegistrar::magentoBuildPath(MagentoOneFileSystem::MAGE_PATH);
                require_once $mageFile;
            }
    
            return true;
        }
        
        if ($this->magento->getInfo()->isMagentoTwo()) {
            if (!class_exists('Magento\Framework\App\Bootstrap')) {
//                require_once DirectoryRegistrar::magentoBuildPath('vendor/autoload.php');
//                require_once DirectoryRegistrar::magentoBuildPath(MagentoTwo::ETC_BOOTSTRAP);
                
//                $bootstrap = \Magento\Framework\App\Bootstrap::create(BP, $_SERVER);
//                $app = $bootstrap->createApplication(\Magento\Framework\App\Cron::class);
            }
            
            return true;
        }
        
        if ($this->magento->getInfo()->isNotMagento()) {
            return true;
        }
        
        return false;
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
