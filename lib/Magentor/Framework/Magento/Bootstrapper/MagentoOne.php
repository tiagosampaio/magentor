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
}
