<?php

namespace Magentor\Framework\App;

class Environment
{
    
    /**
     * @return mixed|null
     */
    public static function getCurrentMagentoModule()
    {
        return defined('MAGENTO_CURRENT_MODULE') ? MAGENTO_CURRENT_VENDOR : null;
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getCurrentMagentoVendor()
    {
        return defined('MAGENTO_CURRENT_VENDOR') ? MAGENTO_CURRENT_VENDOR : null;
    }
    
    
    /**
     * @return string
     */
    public static function getMagentoRoot()
    {
        return defined('MAGENTO_ROOT') ? MAGENTO_ROOT : null;
    }
}
