<?php

namespace Magentor\Framework\App;

class Version
{

    protected static $major = '1';
    protected static $minor = '0';
    protected static $patch = '0';


    /**
     * @return string
     */
    public static function version()
    {
        return implode('.', [self::major(), self::minor(), self::patch()]);
    }


    /**
     * @return string
     */
    public static function major()
    {
        return self::$major;
    }


    /**
     * @return string
     */
    public static function minor()
    {
        return self::$minor;
    }


    /**
     * @return string
     */
    public static function patch()
    {
        return self::$patch;
    }
}
