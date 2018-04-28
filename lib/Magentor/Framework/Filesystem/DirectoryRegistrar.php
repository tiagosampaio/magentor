<?php

namespace Magentor\Framework\Filesystem;

use Magentor\Framework\Magento\FileSystem\MagentoTwo;

class DirectoryRegistrar
{
    
    const DIR_TYPE_ROOT         = 'root';
    const DIR_TYPE_APP          = 'app';
    const DIR_TYPE_LIB          = 'lib';
    const DIR_TYPE_ETC          = 'etc';
    const DIR_TYPE_CODE         = 'code';
    const DIR_TYPE_MAGENTO      = 'magento';
    const DIR_TYPE_MAGENTO_APP  = 'magento_app';
    const DIR_TYPE_MAGENTO_CODE = 'magento_code';
    
    
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
        
        $found = false;
        $count = 0;
        $limit = 50;
        
        while (!$found && ($count <= $limit)) {
            $count++;
            
            if (self::isMagentoModuleDir($magentoDir)) {
                $pieces = explode(DS, $magentoDir);
                
                $module = array_pop($pieces);
                $vendor = array_pop($pieces);
                
                if (!empty($vendor) && !empty($module)) {
                    define('MAGENTO_CURRENT_VENDOR', $vendor);
                    define('MAGENTO_CURRENT_MODULE', $module);
                }
            }
            
            if (!self::isMagentoDir($magentoDir)) {
                $magentoDir = dirname($magentoDir);
                continue;
            }
    
            define('MAGENTO_ROOT', $magentoDir);
            define('MAGENTO_APP',  MAGENTO_ROOT . DS . 'app');
            define('MAGENTO_CODE', MAGENTO_APP . DS . 'code');
    
            self::$dirs[self::DIR_TYPE_MAGENTO]      = MAGENTO_ROOT;
            self::$dirs[self::DIR_TYPE_MAGENTO_APP]  = MAGENTO_APP;
            self::$dirs[self::DIR_TYPE_MAGENTO_CODE] = MAGENTO_CODE;
    
            $found = true;
        }
    }
    
    
    /**
     * @param string $magentoDir
     *
     * @return bool
     */
    protected static function isMagentoModuleDir($magentoDir)
    {
        $registrationFile = $magentoDir . DS . 'registration.php';
        if (!self::isReadable($registrationFile)) {
            return false;
        }
        
        $composerJson = $magentoDir . DS . 'composer.json';
        if (!self::isReadable($composerJson)) {
            return false;
        }
        
        return true;
    }
    
    
    /**
     * @param string $magentoDir
     *
     * @return bool
     */
    protected static function isMagentoDir($magentoDir)
    {
        $requiredFiles = [
            MagentoTwo::PUB_INDEX,
            MagentoTwo::ETC_BOOTSTRAP,
            MagentoTwo::ETC_COMPONENT_REGISTRATION,
            MagentoTwo::ETC_DI_XML,
        ];
        
        foreach ($requiredFiles as $requiredFile) {
            if (!self::isReadable($magentoDir . DS . $requiredFile)) {
                return false;
            }
        }
        
        return true;
    }
    
    
    /**
     * @param string $filename
     *
     * @return bool
     */
    protected static function isReadable($filename)
    {
        $filename = realpath($filename);
        
        $fileExists = static::fileExists($filename);
        return $fileExists && is_readable($filename);
    }
    
    
    /**
     * @param string $filename
     *
     * @return bool
     */
    protected static function fileExists($filename)
    {
        $filename = realpath($filename);
        return file_exists($filename);
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
     * @return mixed|null
     */
    public static function getMagentoCodeDir()
    {
        return self::getDir(self::DIR_TYPE_MAGENTO_CODE);
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
     * @param string $filename
     *
     * @return string
     */
    public static function magentoBuildCodePath($filename)
    {
        return self::buildPath(self::DIR_TYPE_MAGENTO_CODE, $filename);
    }
    
    
    /**
     * @param string $filename
     *
     * @return string
     */
    public static function magentoBuildModulePath($vendor, $module)
    {
        $moduleDir = $vendor . DS . $module;
        return self::buildPath(self::DIR_TYPE_MAGENTO_CODE, $moduleDir);
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
