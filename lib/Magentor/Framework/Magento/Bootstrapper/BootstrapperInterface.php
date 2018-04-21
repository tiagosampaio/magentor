<?php

namespace Magentor\Framework\Magento\Bootstrapper;

use Magentor\Framework\Magento\ApplicationInterface;

interface BootstrapperInterface
{
    
    /**
     * @param ApplicationInterface $magento
     *
     * @return mixed
     */
    public function dispatch(ApplicationInterface $magento);
    
    
    /**
     * @return string
     */
    public function getVersion();
    
    
    /**
     * @return string
     */
    public function getEdition();
    
    
    /**
     * @return string
     */
    public function getEditionInfo();
    
    
    /**
     * @return string
     */
    public function getBaseDir();
    
    
    /**
     * @return string
     */
    public function getModuleDir();
    
    
    /**
     * @param string   $path
     * @param int|null $store
     *
     * @return string|null|mixed
     */
    public function getStoreConfig($path, $store = null);
    
    
    /**
     * @return string
     */
    public function getBaseUrl();
    
    
    /**
     * @return bool
     */
    public function isInstalled();
}
