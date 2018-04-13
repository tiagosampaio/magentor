<?php

namespace Magentor\Framework\Filesystem;

class DirectoryRegistrar
{

    /**
     * @param string $rootDirectory
     */
    public static function register($rootDirectory)
    {
        define('ROOT',     $rootDirectory);
        define('DIR_LIB',  ROOT . '/lib');
        define('DIR_APP',  ROOT . '/app');
        define('DIR_CODE', DIR_APP . '/code');

        self::registerMagento();
    }


    /**
     * @param null $magentoDir
     */
    public static function registerMagento($magentoDir = null)
    {
        if (empty($magentoDir)) {
            $magentoDir = getcwd();
        }

        define('MAGENTO_ROOT', $magentoDir);
    }
}
