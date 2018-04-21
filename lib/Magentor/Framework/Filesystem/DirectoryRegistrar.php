<?php

namespace Magentor\Framework\Filesystem;

class DirectoryRegistrar
{
    
    const DIR_TYPE_ROOT    = 'root';
    const DIR_TYPE_APP     = 'app';
    const DIR_TYPE_LIB     = 'lib';
    const DIR_TYPE_ETC     = 'etc';
    const DIR_TYPE_CODE    = 'code';
    const DIR_TYPE_MAGENTO = 'magento';
    
    
    /** @var array */
    protected static $dirs = [];
    

    /**
     * @param string $rootDirectory
     */
    public static function register($rootDirectory)
    {
        if (!defined('ROOT')) {
            define('ROOT', $rootDirectory);
        }
        
        define('DS', DIRECTORY_SEPARATOR);

        define('DIR_LIB',  ROOT . '/lib');
        define('DIR_APP',  ROOT . '/app');
        define('DIR_ETC',  DIR_APP . '/etc');
        define('DIR_CODE', DIR_APP . '/code');
    
        self::$dirs[self::DIR_TYPE_ROOT] = ROOT;
        self::$dirs[self::DIR_TYPE_LIB]  = DIR_LIB;
        self::$dirs[self::DIR_TYPE_APP]  = DIR_APP;
        self::$dirs[self::DIR_TYPE_ETC]  = DIR_ETC;
        self::$dirs[self::DIR_TYPE_CODE] = DIR_CODE;

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
        self::$dirs[self::DIR_TYPE_MAGENTO] = MAGENTO_ROOT;
    }
    
    
    /**
     * @param string $type
     *
     * @return mixed|null
     */
    public static function getDir($type)
    {
        if (isset(self::$dirs[$type])) {
            return self::$dirs[$type];
        }
        
        return null;
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getRootDir()
    {
        return self::getDir(self::DIR_TYPE_ROOT);
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getAppDir()
    {
        return self::getDir(self::DIR_TYPE_APP);
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getLibDir()
    {
        return self::getDir(self::DIR_TYPE_LIB);
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getEtcDir()
    {
        return self::getDir(self::DIR_TYPE_ETC);
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getCodeDir()
    {
        return self::getDir(self::DIR_TYPE_CODE);
    }
    
    
    /**
     * @return mixed|null
     */
    public static function getMagentoDir()
    {
        return self::getDir(self::DIR_TYPE_MAGENTO);
    }
    
    
    /**
     * @param string $filename
     *
     * @return string
     */
    public static function magentoBuildPath($filename)
    {
        return self::buildPath(self::DIR_TYPE_MAGENTO, $filename);
    }
    
    
    /**
     * @param string $type
     * @param string $filename
     *
     * @return string
     */
    public static function buildPath($type, $filename)
    {
        return self::getDir($type) . DS . $filename;
    }
}
