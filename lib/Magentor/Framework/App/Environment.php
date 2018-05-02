<?php

namespace Magentor\Framework\App;

use Magentor\Framework\Exception\ExceptionContainer;

class Environment
{
    
    public static function initEnvironment()
    {
        self::checkPhpVersion();
    }
    
    
    /**
     * Checks the PHP version.
     */
    protected static function checkPhpVersion()
    {
        if (version_compare(phpversion(), '7', '<')) {
            ExceptionContainer::throwPhpVersionException('This application requires PHP 7 or greater.');
        }
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getCurrentMagentoModule()
    {
        return defined('MAGENTO_CURRENT_MODULE') ? MAGENTO_CURRENT_MODULE : null;
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
