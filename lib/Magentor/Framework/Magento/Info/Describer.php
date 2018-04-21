<?php

namespace Magentor\Framework\Magento\Info;

use Magentor\Framework\Filesystem\DirectoryRegistrar;
use Magentor\Framework\Magento\FileSystem\MagentoOne;

class Describer implements DescriberInterface
{
    
    public function bootstrap()
    {
        $this->describeMagentoDir();
    }
    
    
    protected function describeMagentoDir()
    {
        if ($this->isMagentoOne()) {
            /** @todo Bootstrap Magento 1 */
            return true;
        }
        
        if ($this->isMagentoTwo()) {
            /** @todo Bootstrap Magento 2 */
            return true;
        }
        
        return false;
    }
    
    
    /**
     * @return bool
     */
    public function isMagentoOne()
    {
        if (!$this->magentoIsReadable(MagentoOne::MAGE_PATH)) {
            return false;
        }
        
        if (!$this->magentoIsReadable(MagentoOne::CONFIG_XML_PATH)) {
            return false;
        }
        
        return true;
    }
    
    
    /**
     * @return bool
     */
    public function isMagentoTwo()
    {
        if ($this->isMagentoOne()) {
            return false;
        }
        
        /** @todo Implement the logic to check if it's a Magento 2 version. */
        return false;
    }
    
    
    /**
     * @param string $filename
     *
     * @return bool
     */
    protected function magentoIsReadable($filename)
    {
        $fileExists = $this->magentoFileExists($filename);
        return $fileExists && is_readable(DirectoryRegistrar::magentoBuildPath($filename));
    }
    
    
    /**
     * @param string $filename
     *
     * @return bool
     */
    protected function magentoFileExists($filename)
    {
        return file_exists(DirectoryRegistrar::magentoBuildPath($filename));
    }
}
